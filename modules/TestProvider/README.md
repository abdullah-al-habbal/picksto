# TestProvider Module

## Purpose

Developer utility for testing download provider configurations against a browser automation microservice. Validates that provider credentials and URLs work correctly before deploying them to production.

## Key Entities / Relationships

No models, no migrations, no persistent data.

## API Surface

Not a REST API — calls an external browser service via HTTP:

| Method | Endpoint (external) | Purpose |
|--------|---------------------|---------|
| POST | `{browser.url}/api/test-provider` | Test standard download provider (NirvanaStock or Freepik) |
| POST | `{browser.url}/api/test-custom-bot` | Test custom-bot provider with multi-step navigation |

Internal request validation via `TestProviderRequest`:
- `provider.name`, `provider.email`, `provider.password` (required)
- `provider.providerUrl` (nullable URL)
- `provider.customSteps` (nullable array, for custom bots)
- `testUrl` (required URL, max 2048 chars)

## Events / Listeners

None.

## Integration with the Rest of the System

- **Consumer of Settings module**: Reads `services.browser.url` and `services.browser.secret` from config
- **Consumer of Settings module**: Provider config (email/password/providerUrl) is typically stored in site_config settings managed by the Settings module
- **No Filament UI** — this is a back-end utility called programmatically (likely from admin AJAX endpoints or console commands)
- Currently no routes registered (Routes/web.php does not exist, so `loadRoutes()` is a no-op)

## Config / Env Vars

| Key | Default | Description |
|-----|---------|-------------|
| `services.browser.url` | `http://127.0.0.1:4000` | Browser automation microservice base URL |
| `services.browser.secret` | `''` | API secret for microservice auth (`X-API-Secret` header) |

These must be set in `.env` and `config/services.php`.

## Known Quirks / Dependencies

- **External microservice dependency**: Requires a running browser automation service at `services.browser.url`. Without this, all tests will fail with `Microservice failed` errors
- `testProvider()` auto-detects `Freepik` if `providerUrl` contains "freepik.com", otherwise defaults to `NirvanaStock`
- `testCustomBot()` has a 600-second (10-min) timeout for complex bots
- Both methods use `X-API-Secret` header for auth
- No routes are currently loaded (Routes file doesn't exist); calls must be made programmatically or through routes registered elsewhere
- Request `UploadImageRequest`-style max file size rule (5120 KB) exists in form requests but file upload is not a use case here
