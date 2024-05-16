#!/usr/bin/osascript

set scriptPath to POSIX path of (path to me)
set AppleScript's text item delimiters to "/"
set scriptDirectoryPath to text items 1 thru -2 of scriptPath as text
set AppleScript's text item delimiters to ""

tell application "Mail"
    activate
    set selectedMessages to selection
    set theMessage to item 1 of selectedMessages
    set theReply to reply theMessage with opening window
    tell theReply
        set originalContent to content
        set theData to do shell script "php " & scriptDirectoryPath & "/_reply-joke.php " & quoted form of originalContent
        set theData to theData & return & return
        tell its content
            make new paragraph at beginning with data theData
        end tell
    end tell
end tell