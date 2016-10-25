<?php

/**
 * Texts used in the application.
 * These texts are used via Text::get('FEEDBACK_USERNAME_ALREADY_TAKEN').
 * Could be extended to i18n etc.
 */
return array(
    "FEEDBACK_UNKNOWN_ERROR" => "Okänt fel.",
    "FEEDBACK_DELETED" => "Ditt konto har tagits bort.",
    "FEEDBACK_ACCOUNT_SUSPENDED" => "Ditt konto är låst för ",
    "FEEDBACK_ACCOUNT_SUSPENSION_DELETION_STATUS" => "Denna användarens avstängning / raderings status har ändrats.",
    "FEEDBACK_ACCOUNT_CANT_DELETE_SUSPEND_OWN" => "Du kan inte låsa eller ta bort ditt eget konto.",
    "FEEDBACK_ACCOUNT_USER_SUCCESSFULLY_KICKED" => "Den markerade användaren har tagits bort ur systemet.",
    "FEEDBACK_PASSWORD_WRONG_3_TIMES" => "Du har skrivit fel lösenord 3 eller fler gånger. Vänta 30 sekunder och prova igen.",
    "FEEDBACK_ACCOUNT_NOT_ACTIVATED_YET" => "Kontot är inte aktiverat. Klicka på verifieringslänken i ditt mail.",
    "FEEDBACK_USERNAME_OR_PASSWORD_WRONG" => "Användarnamnet eller lösenordet är fel, Prova igen.",
    "FEEDBACK_USER_DOES_NOT_EXIST" => "Denna användaren existerar inte.",
    "FEEDBACK_LOGIN_FAILED" => "Login misslyckades.",
    "FEEDBACK_LOGIN_FAILED_3_TIMES" => "Login misslyckades 3 eller fler gånger. Vänta 30 sekunder och prova igen.",
    "FEEDBACK_USERNAME_FIELD_EMPTY" => "Användernamn fältet var tomt.",
    "FEEDBACK_PASSWORD_FIELD_EMPTY" => "Lösenord fältet var tomt.",
    "FEEDBACK_USERNAME_OR_PASSWORD_FIELD_EMPTY" => "Användarnamn eller lösenord fältet var tomt.",
    "FEEDBACK_USERNAME_EMAIL_FIELD_EMPTY" => "Användarnamn / email fältet var tomt.",
    "FEEDBACK_EMAIL_FIELD_EMPTY" => "Email fältet var tomt.",
    "FEEDBACK_EMAIL_REPEAT_WRONG" => "Email och repetera email är inte samma.",
    "FEEDBACK_EMAIL_AND_PASSWORD_FIELDS_EMPTY" => "Email och lösenord fält var tomma.",
    "FEEDBACK_USERNAME_SAME_AS_OLD_ONE" => "Det användarnamnet är samma som ditt nuvarande. Välj ett annat.",
    "FEEDBACK_USERNAME_ALREADY_TAKEN" => "Det användarnamnet används redan. Välj ett annat.",
    "FEEDBACK_USER_EMAIL_ALREADY_TAKEN" => "Den emailen används redan. Välj en annan.",
    "FEEDBACK_USERNAME_CHANGE_SUCCESSFUL" => "Ditt användarnamn har ändrats.",
    "FEEDBACK_USERNAME_AND_PASSWORD_FIELD_EMPTY" => "Användanamn och lösenord fälten var tomma.",
    "FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN" => "Användarnamnet passar inte i mönstret: bara a-Z och nummer är tillåtna, 2 till 64 tecken.",
    "FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN" => "Din valda email passar inte i email mönstret.",
    "FEEDBACK_EMAIL_SAME_AS_OLD_ONE" => "Denna email är samma som ditt nuvarande. Välj en annat.",
    "FEEDBACK_EMAIL_CHANGE_SUCCESSFUL" => "Din email har ändrats.",
    "FEEDBACK_CAPTCHA_WRONG" => "Captchan var fel.",
    "FEEDBACK_PASSWORD_REPEAT_WRONG" => "Lösenord och repetera lösenord är inte samma.",
    "FEEDBACK_PASSWORD_TOO_SHORT" => "Lösenordet måste minst vara 6 tecken långt.",
    "FEEDBACK_USERNAME_TOO_SHORT_OR_TOO_LONG" => "Användarnamnet kan inte vara kortare än 2 eller längre än 64 tecken.",
    "FEEDBACK_ACCOUNT_SUCCESSFULLY_CREATED" => "Ditt konto har skapats och vi har skickat ett mail till dig. Klicka på VERIFIERINGS LÄNKEN i detta mail.",
    "FEEDBACK_VERIFICATION_MAIL_SENDING_FAILED" => "Vi kunde inte skicka ett verifierings mail. Ditt konto har INTE skapats.",
    "FEEDBACK_ACCOUNT_CREATION_FAILED" => "Registreringen misslyckades. Var god och prova igen.",
    "FEEDBACK_VERIFICATION_MAIL_SENDING_ERROR" => "Verifierings mailet kunde inte skickas pga: ",
    "FEEDBACK_VERIFICATION_MAIL_SENDING_SUCCESSFUL" => "Ett verifierings mail har skickats.",
    "FEEDBACK_ACCOUNT_ACTIVATION_SUCCESSFUL" => "Aktiveringen lyckades! Du kan logga in nu.",
    "FEEDBACK_ACCOUNT_ACTIVATION_FAILED" => "Den aktiveringskoden du angett är felaktig! Det kan vara så att din mail leverantör (Yahoo? Hotmail?) automatiskt besöker länkar i emails för anti-scam skanning, så denna aktivations länken kanske redan har klickats utan att du har gjort något. Prova gärna att logga in på startsidan.",
    "FEEDBACK_AVATAR_UPLOAD_SUCCESSFUL" => "Avatar uppladdning lyckades.",
    "FEEDBACK_AVATAR_UPLOAD_WRONG_TYPE" => "Bara JPEG och PNG filer är tillåtna.",
    "FEEDBACK_AVATAR_UPLOAD_TOO_SMALL" => "Avatar filens bredd/höjd är för liten. Den måste vara 100x100 pixlar minimum.",
    "FEEDBACK_AVATAR_UPLOAD_TOO_BIG" => "Avatar filen är för stor. 5 Megabyte är max.",
    "FEEDBACK_AVATAR_FOLDER_DOES_NOT_EXIST_OR_NOT_WRITABLE" => "Avatar mappen existerat inte eller så är den ej skrivbar. Ändra detta via chmod 775 eller 777.",
    "FEEDBACK_AVATAR_IMAGE_UPLOAD_FAILED" => "Något gick fel med bild uppladdningen.",
    "FEEDBACK_AVATAR_IMAGE_DELETE_SUCCESSFUL" => "Du tog bort din avatar.",
    "FEEDBACK_AVATAR_IMAGE_DELETE_NO_FILE" => "Du har ingen avatar.",
    "FEEDBACK_AVATAR_IMAGE_DELETE_FAILED" => "Något gick fel när vi tog bort din avatar.",
    "FEEDBACK_PASSWORD_RESET_TOKEN_FAIL" => "Kunde inte skriva token till databasen.",
    "FEEDBACK_PASSWORD_RESET_TOKEN_MISSING" => "Inget återställ lösenord token.",
    "FEEDBACK_PASSWORD_RESET_MAIL_SENDING_ERROR" => "Återställ lösenord mail kunde inte skickas pga: ",
    "FEEDBACK_PASSWORD_RESET_MAIL_SENDING_SUCCESSFUL" => "Ett återställ lösenord mail har skickats.",
    "FEEDBACK_PASSWORD_RESET_LINK_EXPIRED" => "Din återställnings länk har gått ut. Var god och använd länken inom en timme.",
    "FEEDBACK_PASSWORD_RESET_COMBINATION_DOES_NOT_EXIST" => "lösenordåterställningskombinationen existerar inte.",
    "FEEDBACK_PASSWORD_RESET_LINK_EXPIRED" => "Din återställningslänk har gått ut. Var god och använd länken inom en timme.",
    "FEEDBACK_PASSWORD_RESET_COMBINATION_DOES_NOT_EXIST" => "lösenordåterställningskombinationen existerar inte.",
    "FEEDBACK_PASSWORD_RESET_LINK_VALID" => "Återställ lösenord länken är korrekt. Ändra lösenord nu.",
    "FEEDBACK_PASSWORD_CHANGE_SUCCESSFUL" => "Lösenordet ändrades.",
    "FEEDBACK_PASSWORD_CHANGE_FAILED" => "Ändra lösenord misslyckades.",
    "FEEDBACK_PASSWORD_NEW_SAME_AS_CURRENT" => "Det nya lösenordet är samma som det nuvarande löseordet.",
    "FEEDBACK_PASSWORD_CURRENT_INCORRECT" => "Det nuvarande lösenordet skrevs inkorrekt.",
    "FEEDBACK_ACCOUNT_TYPE_CHANGE_SUCCESSFUL" => "Kontotyp ändring lyckades",
    "FEEDBACK_ACCOUNT_TYPE_CHANGE_FAILED" => "Kontotyp ändring misslyckades",
    "FEEDBACK_COOKIE_INVALID" => "Din remember-me-cookie är fel.",
    "FEEDBACK_COOKIE_LOGIN_SUCCESSFUL" => "Du loggades in via din remember-me-cookie.",
    "FEEDBACK_BLOG_SLUG_IN_USE" => "Detta bloggnamnet används redan. Välj ett annat.",
);
