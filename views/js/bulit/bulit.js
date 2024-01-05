
CookieConsent.run({

    // root: 'body',
    // autoShow: true,
    disablePageInteraction: true,
    hideFromBots: true,
    mode: 'opt-in',
    // revision: 0,

    cookie: {
        name: 'cc_cookie',
        domain: location.hostname,
        // path: '/',
        sameSite: "Lax",
        expiresAfterDays: 365,
    },
        guiOptions: {
        consentModal: {
            layout: 'cloud inline',
            position: 'middle center',
            equalWeightButtons: true,
            flipButtons: false
        },
        preferencesModal: {
            layout: 'box',
            equalWeightButtons: true,
            flipButtons: false
        }
    },

    categories: {
                    necessary: {
                enabled: 1,
                readOnly: 1,
                autoClear: {
                    cookies: [{
                                                    name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                             }]
                },
                services: {
                                            14: {
                            label: Google Analytics 2
                        }
                                            15: {
                            label: Google Analytics 2
                        }
                                            16: {
                            label: Google Analytics 2
                        }
                                            17: {
                            label: Google Analytics 2
                        }
                                            18: {
                            label: Google Analytics 2
                        }
                                            19: {
                            label: Google Analytics 2
                        }
                                            20: {
                            label: Google Analytics 2
                        }
                                            21: {
                            label: Google Analytics 2
                        }
                                            22: {
                            label: Google Analytics 2
                        }
                                    }
            }
                    analytics: {
                enabled: 1,
                readOnly: 1,
                autoClear: {
                    cookies: [{
                                                    name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                             }]
                },
                services: {
                                            14: {
                            label: Google Analytics 2
                        }
                                            15: {
                            label: Google Analytics 2
                        }
                                            16: {
                            label: Google Analytics 2
                        }
                                            17: {
                            label: Google Analytics 2
                        }
                                            18: {
                            label: Google Analytics 2
                        }
                                            19: {
                            label: Google Analytics 2
                        }
                                            20: {
                            label: Google Analytics 2
                        }
                                            21: {
                            label: Google Analytics 2
                        }
                                            22: {
                            label: Google Analytics 2
                        }
                                    }
            }
                    ads: {
                enabled: 1,
                readOnly: 1,
                autoClear: {
                    cookies: [{
                                                    name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                                     name:  '/^_ga/'                                             }]
                },
                services: {
                                            14: {
                            label: Google Analytics 2
                        }
                                            15: {
                            label: Google Analytics 2
                        }
                                            16: {
                            label: Google Analytics 2
                        }
                                            17: {
                            label: Google Analytics 2
                        }
                                            18: {
                            label: Google Analytics 2
                        }
                                            19: {
                            label: Google Analytics 2
                        }
                                            20: {
                            label: Google Analytics 2
                        }
                                            21: {
                            label: Google Analytics 2
                        }
                                            22: {
                            label: Google Analytics 2
                        }
                                    }
            }
            },

        language: {
        default: 'pl',
        translations: {
            pl: {
                consentModal: {
                    title: Korzystamy z ciasteczek!,
                    description: Cześć, ta strona używa plików cookie, aby zapewnić jej prawidłowe działanie oraz plików cookie do analizy, aby zrozumieć, jak wchodzisz w interakcję z naszą stroną. Te ostatnie będą ustawiane tylko po wyrażeniu Twojej zgody.,
                    acceptAllBtn: Akceptuj,
                    acceptNecessaryBtn: Odrzuć,
                    showPreferencesBtn: Pozwól mi wybrać,
                    footer: `
                        <a href="#path-to-impressum.html" target="_blank">Impressum</a>
                        <a href="#path-to-privacy-policy.html" target="_blank">Privacy Policy</a>
                    `,
                },
                preferencesModal: {
                    title: Wykorzystanie plików cookie,
                    acceptAllBtn: Akceptuj,
                    acceptNecessaryBtn: Odrzuć,
                    savePreferencesBtn: Zapisz,
                    closeIconLabel: Zamknij okno,
                    serviceCounterLabel: Serwis|Serwisy,
                    sections: [{
                            title: Wykorzystanie plików cookie,
                            description: W tym panelu możesz wyrazić pewne preferencje dotyczące przetwarzania Twoich danych osobowych. Możesz w dowolnym momencie przejrzeć i zmienić wyrażone wybory, powracając do tego panelu za pomocą dostarczonego linku. Aby odmówić zgody na konkretne działania przetwarzania opisane poniżej, przełącz przełączniki w pozycję wyłączoną lub skorzystaj z przycisku „Odrzuć wszystko” i potwierdź chęć zapisania dokonanych wyborów.,
                        },
                                                    title: Niezbędne,
                            linkedCategory: necessary,
                            description: Te pliki cookie są niezbędne do prawidłowego funkcjonowania witryny i nie można ich wyłączyć.,
                            cookieTable: {
                                caption: Tabela plików cookie,
                                headers: {
                                    name: Cookie,
                                    domain: Domena,
                                    desc: Opis
                                },
                                body: [{
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: Test, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: Test, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                    ,
                                }]
                            }
                            
                                                    title: Wydajność i analityka,
                            linkedCategory: analytics,
                            description: Te pliki cookie zbierają informacje o sposobie korzystania z naszej witryny. Wszystkie dane są anonimowe i nie mogą być wykorzystane do identyfikacji użytkownika.,
                            cookieTable: {
                                caption: Tabela plików cookie,
                                headers: {
                                    name: Cookie,
                                    domain: Domena,
                                    desc: Opis
                                },
                                body: [{
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: Test, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: Test, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                    ,
                                }]
                            }
                            
                                                    title: Targetowanie i reklama,
                            linkedCategory: ads,
                            description: Te pliki cookie są wykorzystywane w celu lepszego dopasowania komunikatów reklamowych do użytkownika i jego zainteresowań. Celem jest wyświetlanie reklam, które są odpowiednie i angażujące dla poszczególnych użytkowników, a tym samym bardziej wartościowe dla wydawców i zewnętrznych reklamodawców.,
                            cookieTable: {
                                caption: Tabela plików cookie,
                                headers: {
                                    name: Cookie,
                                    domain: Domena,
                                    desc: Opis
                                },
                                body: [{
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: Test, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: Test, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                                                            name: /^_ga/,
                                        domain: location.hostname,
                                        desc: adwad, 
                                    ,
                                }]
                            }
                            
                                            ]
                }
            }
        }
    }
});
