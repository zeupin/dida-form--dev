set TARGET_DIR=D:\Projects\github\dida-form

copy /y  README.md      "%TARGET_DIR%\"
copy /y  LICENSE        "%TARGET_DIR%\"
copy /y  composer.json  "%TARGET_DIR%\"
copy /y  .gitignore     "%TARGET_DIR%\"

del /f /s /q            "%TARGET_DIR%\src\*.*"
rd /s /q                "%TARGET_DIR%\src\"
xcopy /y /s  src        "%TARGET_DIR%\src\"

ping -n 5 127.0.0.1>nul