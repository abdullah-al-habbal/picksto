<!-- filePath: /home/lenovo/work/projects/the_picksto/picksto/modules/Ticket/README.md -->
# Ticket Module

## Purpose

Support ticket system enabling users to submit tickets and admins to reply and manage them. Supports soft-deletes for record retention.

## Key Entities / Relationships

| Table | Model | Key Columns | Relations |
|-------|-------|-------------|-----------|
| `tickets` | `TicketModel` | `user_id`, `subject`, `message`, `status` (open/pending/closed/resolved), `priority` (low/medium/high), soft deletes | `user` → `UserModel`, `replies` → `TicketReplyModel` (HasMany) |
| `ticket_replies` | `TicketReplyModel` | `ticket_id`, `user_id`, `message`, `is_admin` (boolean) | `ticket` → `TicketModel`, `user` → `UserModel` |

Scopes: `open()`, `pending()`, `byUser()`

## API Endpoints

No dedicated REST API. All operations via Filament:
- **Admin**: `TicketResource` (full CRUD) with:
  - `TicketActions::changeStatus()` — modal with status select (open/in_progress/closed)
  - `TicketActions::addReply()` — modal with textarea
  - `RepliesRelationManager` — nested table on ticket view
- **Client**: `TicketResource` (create, view own, list own — all scoped to `auth()->id()`)

## Events / Listeners

None.

## Integration with the Rest of the System

- **User module**: Tickets and replies FK to `users`; `is_admin` flag on replies is set based on auth user role (admin/supervisor)
- **RepliesRelationManager** is auto-discovered by the admin panel provider
- Client resource uses `getEloquentQuery()` scoping to prevent cross-user ticket access

## Config / Env Vars

No dedicated env vars.

## Known Quirks / Dependencies

- `TicketRepository::addReply()` automatically sets ticket status to "pending" when a non-admin replies
- `TicketRepository::authorizeView()` has a no-op fallback (`orWhereRaw('1=0')`) that effectively restricts to own user only, but then checks `isAdmin()` — this is a roundabout approach
- `SoftDeletes` is used on tickets but not on replies (replies cascade-delete with ticket via FK)
- `TicketActions::changeStatus()` offers `in_progress` as an option but the migration only defines `open/pending/closed/resolved` — potential mismatch
- No notification is sent to the user when an admin replies
