# Security test feedback


Authenticatie:
Er is geen authenticatie

HTTPS:  
alle publiek bereikbare onderdelen van de web applicatie zijn enkel bereikbaar via HTTPS.
Het domein krijgt een A+ score bij SSL Labs server test.
De website staat in de HSTS Google Chrome preload list.
Er is een CAA record voor het domein.

Typische web vulnerabilities:
Er wordt gebruik gemaakt van session cookies.
Er wordt gebruik gemaakt van SameSite: Lax zijn om het risico op CSRF te beperken.
Er is een CSRF token bij elk formulier dat server-side wordt gecontroleerd.
De sessions verlopen.
Er wordt geen gebruik gemaakt van secure flag om het access token te transporteren tussen een SPA en de REST API.
Er is geen X-Frame-Options header om clickjacking te vermijden.
Er wordt geen overbodige code ingeladen.

REST: 
Er wordt gebruik gemaakt van een GET & POST HTTP verb op de manier die wordt beschreven volgens het Richardson Maturity Model.
application/json wordt ondersteund door de REST API.
De API geeft een status 200 code terug bij een successvolle POST request.
De API geeft geen status code 400 terug bij een onsuccessvolle POST request(invalid parameter). Deze geeft in de plaats daarvan ook een status code 200 terug.
Er is geen authenticatie dus hierop kunnen we geen requests testen.
Er zijn geen permissions dus hierop kunnen we niet testen.
een GET request op een niet bestaande resource resulteert in een status code 404.
een POST request naar een resource die enkel GET aanvaard resulteert in een status code 405. Bij het sturen van deze request krijgen we de debugmode van de website te zien.

