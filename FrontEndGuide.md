# Frontend Files

## Blade Views (Server-rendered templates)

Code
resources/views/
├── layouts/
│   ├── app.blade.php                    # Main authenticated layout
│   └── guest.blade.php                  # Guest/unauthenticated layout
├── landing.blade.php                    # Public landing page
├── terms.blade.php                      # Terms of service page
├── api/
│   └── index.blade.php                  # API tokens page
├── livewire/
│   └── edit-item.blade.php              # Item editing component
└── components/
    ├── button.blade.php                 # Reusable button component
    ├── label.blade.php                  # Reusable label component
    ├── checkbox.blade.php               # Reusable checkbox component
    └── dropdown.blade.php               # Reusable dropdown component

## Stylesheets (CSS/Tailwind)

Code
resources/css/
└── app.css                              # Main styles with Tailwind directives
JavaScript
Code
resources/js/
└── app.js                               # Main JS entry point (currently minimal)
Public Assets (Static server files)
Code
public/
├── index.php                            # Laravel entry point
├── .htaccess                            # URL rewriting rules
└── robots.txt                           # SEO robots configuration

## Note: This details may be incomplete.

    Most of your frontend is Blade templates + Tailwind CSS. The JS file is minimal, suggesting you're likely using Livewire for interactivity (as seen in the livewire components).
