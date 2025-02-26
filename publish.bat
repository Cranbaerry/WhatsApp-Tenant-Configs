:: Delete files in the dist folder
del /f /q "%cd%\dist\*"

REM Check if a parameter is provided
IF "%~1"=="" (
    echo Usage: %0 CommitMessage
    goto :eof
)

set "source=%cd%"
set "destination=%cd%/dist/output.zip"
set "exclude1=dist"
set "exclude2=dist"
:: set "exclude2=administrator\assets\php\vendor"
set "exclude3=.git"

"C:\Program Files\7-Zip\7z.exe" a -tzip -mx1 -xr!%exclude1% -xr!%exclude2% -xr!%exclude3% "%destination%" "%source%\*"

SET "CommitMessage=%~1"
git add .
git commit -m "%CommitMessage%"
git push

echo Done!

pause