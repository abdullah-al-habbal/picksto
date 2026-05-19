# Backlog — Filament Completion

Status key: **Done** | **Open**

## P0 — Auth & data integrity (Done)

| ID | Task | Acceptance | Status |
|----|------|------------|--------|
| P0-1 | `AUTH_GUARD` / `AUTH_MODEL` in `.env.example` + `config/auth.php` defaults | Fresh install can log into both panels after migrate/seed | Done |
| P0-2 | Fix `UserModel` `email_verified` cast | Matches boolean column | Done |
| P0-3 | Remove invalid `TicketModel::is_admin` cast | No cast for non-existent column | Done |
| P0-4 | Register `CheckUserBanMiddleware` on admin + client panels | Banned user redirected to panel login | Done |

## P1 — Admin gaps (Done)

| ID | Task | Acceptance | Status |
|----|------|------------|--------|
| P1-1 | `ReferralSettings` admin page | Edit singleton `referral_settings` row | Done |
| P1-2 | `ReferralRewardResource` admin | List/view/edit rewards | Done |
| P1-3 | Remove Package `Users` stub | No empty `Resources/Users/` tree | Done |

## P2 — Client completion (Done)

| ID | Task | Acceptance | Status |
|----|------|------------|--------|
| P2-1 | Localize Profile + Subscription navigation/notifications | en/ar keys | Done |
| P2-2 | Add `account`, `growth`, `billing` dashboard groups | en/ar | Done |
| P2-3 | `ClientPanelProvider::profile(ProfilePage::class)` | Panel profile menu works | Done |
| P2-4 | `CatalogPage` for products | Active products grid, localized | Done |
| P2-5 | Plans success → link to subscription requests | Notification action URL | Done |

## P3 — Polish (Done)

| ID | Task | Acceptance | Status |
|----|------|------------|--------|
| P3-1 | `LanguageSwitch` in `ApplicationServiceProvider` | en/ar switcher in panels | Done |
| P3-2 | Remove legacy `resources/views/modules/*` | Directory removed | Done |
| P3-3 | Ticket nav badge = open/pending count | Cached 5 min | Done |
| P3-4 | Subscription request badge = pending count | Cached 5 min | Done |

## Future (optional)

| ID | Task | Notes |
|----|------|-------|
| F-1 | Client ticket replies | Relation manager or inline on `ViewTicket` |
| F-2 | Remove dead `loadRoutes()` from modules without `Routes/web.php` | Low risk cleanup |
| F-3 | `@source` language-switch in theme CSS | Required for full plugin styling per package README |
| F-4 | API routes module consolidation | Out of Filament scope |

## Definition of done (panels “final”)

1. Every persisted entity has admin UI OR documented exception.
2. Every client workflow has scoped Filament UI.
3. Navigation 100% translated (en/ar).
4. Fresh clone: env + migrate + seed → both panels login.
5. `CLAUDE.md` + `docs/specs/*` match codebase.
