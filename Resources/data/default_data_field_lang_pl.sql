INSERT INTO `PREFIX_ds_gprd_cookie_field_lang`(`id_lang`, `text_value`, `field_id`) VALUES 
    (1, 'Korzystamy z ciasteczek!', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'consentModal_title')),
    (1, 'Cześć, ta strona używa plików cookie, aby zapewnić jej prawidłowe działanie oraz plików cookie do analizy, aby zrozumieć, jak wchodzisz w interakcję z naszą stroną. Te ostatnie będą ustawiane tylko po wyrażeniu Twojej zgody.', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'consentModal_description')),
    (1, 'Akceptuj', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'consentModal_acceptAllBtn')),
    (1, 'Odrzuć', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'consentModal_acceptNecessaryBtn')),
    (1, 'Pozwól mi wybrać', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'consentModal_showPreferencesBtn')),
    (1, '<a href="#path-to-impressum.html" target="_blank">Nota prawna</a><a href="#path-to-privacy-policy.html" target="_blank">Polityka prywatności</a>', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'consentModal_footer')),
    (1, 'Wykorzystanie plików cookie', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_title')),
    (1, 'Akceptuj', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_acceptAllBtn')),
    (1, 'Odrzuć', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_acceptNecessaryBtn')),
    (1, 'Zapisz', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_savePreferencesBtn')),
    (1, 'Zamknij okno', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_closeIconLabel')),
    (1, 'Serwis|Serwisy', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_serviceCounterLabel')),
    (1, 'Wykorzystanie plików cookie', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_serviceCounterLabel_sections_title')),
    (1, 'W tym panelu możesz wyrazić pewne preferencje dotyczące przetwarzania Twoich danych osobowych. Możesz w dowolnym momencie przejrzeć i zmienić wyrażone wybory, powracając do tego panelu za pomocą dostarczonego linku. Aby odmówić zgody na konkretne działania przetwarzania opisane poniżej, przełącz przełączniki w pozycję wyłączoną lub skorzystaj z przycisku „Odrzuć wszystko” i potwierdź chęć zapisania dokonanych wyborów.', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_serviceCounterLabel_sections_description')),
    (1, 'Tabela plików cookie', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_serviceCounterLabel_sections_cookieTable_caption')),
    (1, 'Cookie', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_serviceCounterLabel_sections_cookieTable_headers_name')),
    (1, 'Domena', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_serviceCounterLabel_sections_cookieTable_headers_domain')),
    (1, 'Opis', (SELECT id FROM PREFIX_ds_gprd_cookie_field WHERE field_name = 'preferencesModal_serviceCounterLabel_sections_cookieTable_headers_desc'));

