# Git Push Rule

Trigger: Whenever the user enters "push" or requests git push.

Execution steps:
1. Stage all changes: `git add .`
2. Commit with informative message: `git commit -m "<message>"`
3. Pull and merge from remote: `git pull --no-edit origin main`
4. Push to remote main: `git push origin main`
5. Report status and latest commit hash to the user.
