# DGP Services SDK (Contracts + DTOs)

A **Laravel-first SDK** that defines the **service-driver contracts** your DGP plugins implement, plus the **typed DTO payloads** (Requests/Responses/Types) they exchange with the host.

This package is **not** your plugin system. Your plugin system already:

* installs/enables plugins
* collects config requirements + renders admin settings UI
* loads the plugin’s exported class (default export)
* passes a `dgp_handler` / runtime context (and the plugin can also read its own config)

**This SDK’s job** is to standardize what that exported class implements, so the Host can call any provider in a uniform way.

---

## What this package enables

### 1) Capability-based drivers

Drivers implement only what they support (refill, cancel, bulk, fast-schema, etc.). The Host checks support via `instanceof` (and/or a capability map).

```php
if ($driver instanceof OrderRefillContract) {
    // refill supported
}
```

### 2) Typed payloads (no magic arrays)

Every call uses typed **Request DTOs** and returns typed **Response DTOs**, wrapped in a consistent `Result<T>`.

### 3) A clean “Driver layer”

A registry + resolver + manager gives the Host a single way to:

* register available drivers
* resolve a driver by key
* call capability methods safely
* apply boundary wrappers (normalize errors, retry rules, rate-limit hints, etc.)

### 4) A baseline for panel-like providers

Using **JustAnotherPanel** as the reference model, the SDK targets common features:

services → order create/status → balance → optional cancel/refill/bulk.

---

## Two-lane schema model (important)

Providers can integrate at two schema levels:

### Lane A — Raw / Baseline (Host-owned normalization)

* **Contract:** `ServicesCatalogContract` (**MUST**)
* **Returns:** `ServiceDefinition[]` (raw list)
* **Host job:** normalize raw services into the Host’s internal UI state (tags/fields/options/constraints) using Host rules.

This is the default and works for every provider.

### Lane B — Fast lane / Pre-normalized (Advanced)

* **Contract:** `ServiceSchemaContract` (**OPTIONAL / ADVANCED**)
* **Returns:** `ServiceProps` (TS-parity UI schema)
* **Host job:** **verify + clamp + cache** the schema, then serve to frontend.

This lane exists for sophisticated plugins that already compute the full UI schema.

> “Fast lane” does **not** mean blind trust. The Host validates and can reject/fallback to Lane A.

---

## Decisions locked in

* **Result-first return strategy:** contract calls return `Result<ResponseDto>` so business failures (insufficient funds, rate-limited, invalid params) are first-class outcomes.
* **Exceptions are internal:** throw only for unrecoverable/system/invariant issues (transport, misconfiguration). `DriverManager` converts them to `Result` at the boundary.
* **TS parity for `ServiceProps`:** schema types must serialize into the *exact JSON keys* your React UI expects (snake_case + camelCase as designed).
* **Pre-flight validation:** validate DTO invariants before any HTTP call.
* **Safe schema execution:** any “code-like” fields (e.g., quantity `eval` + `code`) must be treated as a **DSL / restricted expression**, never raw eval.

---

## Critical implementation note: Lane B serialization keys

Your TS schema uses a mixed key convention (example: pricing_role but quantityDefault).

Do not rely on automatic property names for Lane B. Types/Schema/* should implement JsonSerializable (or your Arrayable) and explicitly output the correct keys:

```php
public function jsonSerialize(): array {
    return array_filter([
        'id' => $this->id,
        'pricing_role' => $this->pricing_role,
        'quantityDefault' => $this->quantityDefault,
    ], fn ($v) => $v !== null);
}
```

---

## Folder structure map (src)

```txt
src/
  DgpSdk.php
  DgpSdkServiceProvider.php

  Driver/
    DriverContext.php                   // runtime context: config + services (transport/logger/cache/clock)
    DriverRegistry.php                  // registered driver factories + metadata
    DriverResolver.php                  // resolve driver instance by key (registry + context)
    DriverManager.php                   // boundary wrapper: resolve + capability helpers + Result wrapping
    AbstractServiceDriver.php           // base class: core helpers + HealthCheck default

  Contracts/
    Catalog/
      ServicesCatalogContract.php       // CORE (MUST): raw service catalog (Lane A)
      ServiceInputSchemaContract.php    // OPTIONAL: minimal per-service input schema (Host still normalizes)
      ServiceSchemaContract.php         // OPTIONAL/ADVANCED: pre-normalized ServiceProps (Lane B fast lane)

    Orders/
      OrderCreateContract.php           // CORE (MUST): place order
      OrderStatusContract.php           // CORE (MUST): status lookup
      OrderCancelContract.php           // OPTIONAL: cancel

    Balance/
      BalanceContract.php               // CORE (MUST for panel-like): provider balance

    Refill/
      OrderRefillContract.php           // OPTIONAL: create refill
      RefillStatusContract.php          // OPTIONAL: refill status

    Bulk/
      BulkOrderCreateContract.php       // OPTIONAL: bulk create
      BulkOrderStatusContract.php       // OPTIONAL: bulk status

    Subscription/
      SubscriptionContract.php          // OPTIONAL: subscription lifecycle

    DripFeed/
      DripFeedContract.php              // OPTIONAL: dripfeed lifecycle

    Infra/
      TransportContract.php             // HOST-PROVIDED transport interface (Laravel adapter lives in host)
      AuthStrategyContract.php          // OPTIONAL: driver-specific auth strategy
      ErrorNormalizerContract.php       // CORE (MUST): normalize provider errors into DgpError
      RetryPolicyContract.php           // OPTIONAL: retry/backoff decisions
      RateLimitPolicyContract.php       // OPTIONAL: rate limit hints/windows
      IdempotencyContract.php           // OPTIONAL: idempotency rules

    Discovery/
      CapabilitiesContract.php          // CORE (MUST): declare supported capabilities
      ServiceMapperContract.php         // OPTIONAL: host↔provider mapping helper

    Ops/
      HealthCheckContract.php           // CORE (MUST via AbstractServiceDriver): health/ping
      AuditTrailContract.php            // OPTIONAL: audit hooks
      WebhookIngestContract.php         // OPTIONAL: webhook parsing/verification

  Payloads/
    Requests/
      Catalog/
        ListServicesRequest.php
        GetServiceInputSchemaRequest.php
        GetServiceSchemaSnapshotRequest.php
        GetServiceSchemaForServiceRequest.php

      Orders/
        CreateOrderRequest.php
        GetOrderStatusRequest.php
        CancelOrderRequest.php

      Balance/
        GetBalanceRequest.php

      Refill/
        CreateRefillRequest.php
        GetRefillStatusRequest.php

      Bulk/
        BulkCreateOrdersRequest.php
        BulkGetOrderStatusRequest.php

      Subscription/
        CreateSubscriptionRequest.php
        GetSubscriptionStatusRequest.php
        CancelSubscriptionRequest.php

      DripFeed/
        CreateDripFeedRequest.php
        GetDripFeedStatusRequest.php
        CancelDripFeedRequest.php

      Infra/
        HttpRequestDto.php
        AuthApplyRequest.php
        NormalizeErrorRequest.php
        RetryDecisionRequest.php
        RateLimitHintRequest.php
        MakeIdempotencyKeyRequest.php

      Discovery/
        GetCapabilitiesRequest.php
        ResolveProviderServiceRequest.php

      Ops/
        HealthCheckRequest.php
        AuditRecordRequest.php
        ParseWebhookRequest.php

    Responses/
      Catalog/
        ListServicesResponse.php
        GetServiceInputSchemaResponse.php
        GetServiceSchemaSnapshotResponse.php
        GetServiceSchemaForServiceResponse.php

      Orders/
        CreateOrderResponse.php
        GetOrderStatusResponse.php
        CancelOrderResponse.php

      Balance/
        GetBalanceResponse.php

      Refill/
        CreateRefillResponse.php
        GetRefillStatusResponse.php

      Bulk/
        BulkCreateOrdersResponse.php
        BulkGetOrderStatusResponse.php

      Subscription/
        CreateSubscriptionResponse.php
        GetSubscriptionStatusResponse.php
        CancelSubscriptionResponse.php

      DripFeed/
        CreateDripFeedResponse.php
        GetDripFeedStatusResponse.php
        CancelDripFeedResponse.php

      Infra/
        HttpResponseDto.php
        AuthApplyResponse.php
        NormalizeErrorResponse.php
        RetryDecisionResponse.php
        RateLimitHintResponse.php
        MakeIdempotencyKeyResponse.php

      Discovery/
        GetCapabilitiesResponse.php
        ResolveProviderServiceResponse.php

      Ops/
        HealthCheckResponse.php
        AuditRecordResponse.php
        ParseWebhookResponse.php

  Types/
    Money.php
    Currency.php

    Service/
      ServiceDefinition.php             // raw baseline service item (strict core + meta bag)
      ServiceCategory.php
      ServiceTag.php
      ServiceInputSchema.php            // minimal per-service schema (Lane A helper)
      ServiceField.php
      ServiceFieldRule.php

    Schema/                             // TS-parity UI schema (Lane B: ServiceProps)
      ServiceProps.php
      Tag.php
      Field.php
      FieldOption.php
      ServiceFallback.php

      Ui/
        UiNode.php
        UiString.php
        UiNumber.php
        UiBoolean.php
        UiAnyOf.php
        UiArray.php
        UiObject.php

    Orders/
      OrderRef.php
      OrderStatus.php
      OrderStatusCode.php

    Balance/
      ProviderBalance.php

    Refill/
      RefillRef.php
      RefillStatus.php
      RefillStatusCode.php

    Subscription/
      SubscriptionRef.php
      SubscriptionStatus.php
      SubscriptionStatusCode.php

    DripFeed/
      DripFeedRef.php
      DripFeedStatus.php
      DripFeedStatusCode.php

    Infra/
      CapabilityMap.php
      ProviderRateLimit.php
      ProviderRateLimitWindow.php
      IdempotencyKey.php
      HttpMethod.php

    Ops/
      HealthState.php
      AuditRecord.php
      WebhookEvent.php
      WebhookEventType.php

  Support/
    Result.php                          // Result<T>: success/failure wrapper
    DgpError.php
    DgpErrorCode.php

    Exceptions/
      DgpException.php
      TransportException.php
      AuthException.php
      ProviderException.php
      RateLimitedException.php
      ValidationException.php

    Hydration/
      HydratesFromArray.php             // trait for DTO ::fromArray(...)
      DtoHydrator.php                   // optional helper for host/controller DTO creation

    Validation/
      PayloadValidator.php              // pre-flight validation + schema verification

    Serialization/
      Arrayable.php
      Normalizes.php

    Testing/
      FakeTransport.php
      FakeClock.php
```

---

## The flow this SDK expects

1. **Host** loads a plugin (your existing system) → obtains the exported driver class.
2. **Host** resolves a driver instance via `DriverResolver` / `DriverManager`.
3. **Host** calls capabilities (catalog/order/status/balance/etc.) via the driver interfaces.
4. **Driver** returns typed DTO responses wrapped in `Result<T>`, with normalized errors.

---

## Driver layer (src/Driver)

### `DriverRegistry`

Stores driver registrations:

* `driver_key` → factory/closure/class string
* optional metadata (label, version, category)

**Why:** central place to list available drivers and ensure uniqueness.

### `DriverResolver`

Creates driver instances from:

* registry entry
* runtime configuration (plugin settings, handler context, etc.)

**Why:** a single resolution path so the Host never does `new` directly.

### `DriverManager`

High-level façade used by the Host:

* `resolve($key)`
* convenience helpers for “must support X contract”
* safe wrappers for common patterns (error normalization, retry/backoff decisions)

**Why:** keeps Host code clean and consistent.

### `AbstractServiceDriver` (base class)

An abstract driver with shared core behavior, including **Health** as a baseline.

Recommended built-ins:

* implements `HealthCheckContract`
* common helpers: `ok()`, `fail()`, `wrapExceptions()`
* convenience access to handler/config
* shared normalization utilities

**Why:** eliminates boilerplate and standardizes minimal behavior across drivers.

---

## Contract map (what each does)

### Core contracts (MUST for a panel-like provider)

* **`ServicesCatalogContract`**

    * Raw services list: `ServiceDefinition[]`.
    * Enables discovery/mapping and Host-owned normalization (Lane A).

* **`OrderCreateContract`**

    * Place an order.

* **`OrderStatusContract`**

    * Fetch order status.

* **`BalanceContract`**

    * Fetch provider balance.

* **`CapabilitiesContract`**

    * Declare supported features (cancel/refill/bulk/schema/etc.).

* **`ErrorNormalizerContract`**

    * Normalize any provider error shape into `DgpError`.

* **`HealthCheckContract`** (provided by `AbstractServiceDriver`)

    * Quick health/ping/config sanity.

### Schema contracts (optional, but powerful)

* **`ServiceInputSchemaContract` (optional helper for Lane A)**

    * Returns minimal per-service fields (`ServiceInputSchema`).
    * The Host still owns final UI normalization.

* **`ServiceSchemaContract` (optional/advanced: Lane B fast lane)**

    * Returns **pre-normalized `ServiceProps`**.
    * Must support both shapes:

        * **Snapshot**: provider-wide schema for caching.
        * **Per-service**: focused schema for a single service.
    * Host validates/clamps; can fallback to Lane A if invalid.

### Common add-ons (optional)

* **Cancel:** `OrderCancelContract`
* **Refill:** `OrderRefillContract`, `RefillStatusContract`
* **Bulk:** `BulkOrderCreateContract`, `BulkOrderStatusContract`
* **Subscription:** `SubscriptionContract`
* **Drip feed:** `DripFeedContract`

### Infra policy hooks (optional)

* **Transport:** `TransportContract` (host-provided interface)
* **Auth:** `AuthStrategyContract`
* **Retry:** `RetryPolicyContract`
* **Rate limit:** `RateLimitPolicyContract`
* **Idempotency:** `IdempotencyContract`

### Ops hooks (optional)

* **Audit:** `AuditTrailContract`
* **Webhooks:** `WebhookIngestContract`

---

## DTOs (Payloads + Types)

### Requests (`src/Payloads/Requests`)

Input DTOs passed by the Host.

Rules:

* explicit fields, no magic arrays
* allow `meta` only when intentionally flexible

### Responses (`src/Payloads/Responses`)

Typed results returned by drivers.

Rules:

* canonical normalized data
* optional `meta` for provider-specific extras

### Shared Types (`src/Types`)

Reusable building blocks shared across payloads.

Key split:

* `Types/Service/*` → raw service list + minimal input schema (Lane A)
* `Types/Schema/*` → TS-parity `ServiceProps` UI schema (Lane B)

---

## Support layer (`src/Support`)

### Result + Errors

A consistent return model:

* `Result<T>` — success/failure wrapper
* `DgpError` + `DgpErrorCode` — canonical error representation

### Exceptions

Typed exceptions for internal ergonomics (`TransportException`, `AuthException`, etc.). Drivers can throw internally, while `DriverManager` wraps/normalizes into `Result`.

### Validation / Serialization / Testing

* pre-flight validation helpers
* schema verification helpers (Lane B)
* serialization interfaces
* fakes (`FakeTransport`, `FakeClock`) for unit tests

---

## Implementation plan (what we do next, in order)

### Step 1 — Foundation (everything depends on this)

* `Result<T>` + `DgpError` + `DgpErrorCode`
* `DriverContext` + `DriverManager` boundary wrapping
* `PayloadValidator` for pre-flight + schema verification

### Step 2 — Raw lane MVP (most providers)

* `ServicesCatalogContract` + `ServiceDefinition`
* `OrderCreateContract`, `OrderStatusContract`, `BalanceContract`
* `ErrorNormalizerContract`, `CapabilitiesContract`
* health check baseline

### Step 3 — Optional helpers

* `ServiceInputSchemaContract` + `ServiceInputSchema`
* mapping helpers if needed

### Step 4 — Fast lane (advanced)

* `Types/Schema/*` (TS-parity `ServiceProps`)
* `ServiceSchemaContract` snapshot + per-service
* strict validation + versioning + clamp rules

### Step 5 — JAM add-ons

* cancel, refill, bulk

### Step 6 — Remaining optional capabilities

* subscription, dripfeed
* infra hooks (retry/rate-limit/idempotency)
* ops hooks (audit/webhooks)

---

## What this package deliberately does NOT do

* install/enable/disable plugins (your system already does this)
* store plugin settings (your system already does this)
* define host database schema
* enforce UI implementation details (it only defines contracts + typed shapes)
