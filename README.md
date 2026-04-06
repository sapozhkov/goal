Goal list
=========

It is like a simple todo list. But it's for global aims.

It just a list of your goals with:
* sub tasks
* date of set
* date to be done
* percent of complition
* progress messages
* log of events

Just an instrument for visual showing your golas with histtory of progress.

Can be used for:
* planing (SMART avaliable)
* reviewing your plans
* nostalging of what was made and what was not

Docker
======

Local launch is prepared with Docker Compose.

1. Optionally copy `.env.example` to `.env` and adjust values.
2. Start the stack:

   ```bash
   docker compose up --build
   ```

3. Open [http://localhost:8080](http://localhost:8080)
4. Login with `demo` / `demo`

What happens on startup:

* PHP dependencies are installed with Composer inside the app container.
* Missing local config files are generated from `config/*.dist`.
* Yii migrations are applied automatically.
* Base status / priority / type dictionaries are seeded automatically.
