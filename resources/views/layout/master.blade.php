<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نمایش کد C با Prism.js</title>

    <!-- Prism.js theme -->
    <link rel="stylesheet" href="{{asset('assets/library/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/tree.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-tomorrow.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 50px 20px;
            font-family: Tahoma, Arial, sans-serif;
            color: #1e293b;
        }

        .container {
            max-width: 950px;
            margin: 0 auto;
        }

        .header {
            margin-bottom: 22px;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 10px;
            border-radius: 999px;
            background: #e0e7ff;
            color: #4338ca;
            font-size: 12px;
            font-weight: bold;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        .description {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .code-card {
            overflow: hidden;
            border: 1px solid #cbd5e1;
            border-radius: 14px;
            background: #1e1e1e;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.16);
        }

        .code-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            direction: ltr;
            padding: 12px 16px;
            background: #18181b;
            border-bottom: 1px solid #2f2f2f;
        }

        .file-name {
            color: #d4d4d4;
            font-family: Consolas, Monaco, monospace;
            font-size: 13px;
        }

        .dots {
            display: flex;
            gap: 7px;
        }

        .dot {
            width: 11px;
            height: 11px;
            border-radius: 50%;
            background: #666;
        }

        .dot.red { background: #ff5f56; }
        .dot.yellow { background: #ffbd2e; }
        .dot.green { background: #27c93f; }

        pre[class*="language-"] {
            direction: ltr;
            text-align: left;
            margin: 0 !important;
            border-radius: 0 !important;
            padding: 24px !important;
            font-size: 15px;
            line-height: 1.8;
            min-height: 280px;
        }

        code[class*="language-"] {
            font-family: Consolas, "Courier New", monospace;
        }

        .footer {
            margin-top: 12px;
            color: #94a3b8;
            font-size: 12px;
            text-align: left;
            direction: ltr;
        }

        .token.comment {
            color: #7f8c98 !important;
            font-style: italic;
        }

        @media (max-width: 600px) {
            body {
                padding: 25px 12px;
            }

            h1 {
                font-size: 23px;
            }

            pre[class*="language-"] {
                font-size: 13px;
                padding: 18px !important;
            }
        }
    </style>
</head>

<body>
    <section class="profile bg-white py-4">
        <div class="container-fluid">
            <div class="row g-3 px-md-4">
                <div class="col-lg-9">
                    <div class="container">
                        <div class="code-card">
                            <div class="code-header">
                                <div class="dots">
                                    <span class="dot red"></span>
                                    <span class="dot yellow"></span>
                                    <span class="dot green"></span>
                                </div>
                                <span class="file-name">@yield('nameSpace')</span>
                            </div>
                            <pre><code class="language-c">@yield('code')</code></pre>
                        </div>
                        <div class="footer">C source code • Prism.js</div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="profile-sidebar">
                        <div class=" border rounded-3 py-3">
                            <ul class="tree">
                                <li><details><summary class="text-start text-sorme">.metadata</summary></details></li>
                                <li><details><summary class="text-start text-sorme">.settings</summary></details></li>
                                <li>
                                    <details {{ request()->is('core*') ? 'open' : ''}}>
                                        <summary class="text-start text-sorme">
                                            Core
                                        </summary>
                                        <ul class="tree">
                                            <li>
                                                <details {{ request()->is('core/inc*') ? 'open' : ''}}>
                                                    <summary class="text-start text-sorme">
                                                        Inc
                                                    </summary>
                                                    <ul>
                                                        <li class="text-start">
                                                            <a href="{{ url('core/inc/main') }}" class="{{ request()->is('core/inc/main') ? 'text-info' : 'text-off' }}">
                                                                main.h
                                                            </a>
                                                        </li>
                                                        <li class="text-start">
                                                            <a href="{{ url('core/inc/stm32f1xx_hal_conf') }}" class="{{ request()->is('core/inc/stm32f1xx_hal_conf') ? 'text-info' : 'text-off' }}">
                                                                stm32f1xx_hal_conf.h
                                                            </a>
                                                        </li>
                                                        <li class="text-start">
                                                            <a href="{{ url('core/inc/stm32f1xx_it') }}" class="{{ request()->is('core/inc/stm32f1xx_it') ? 'text-info' : 'text-off' }}">
                                                                stm32f1xx_it.h
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </details>
                                            </li>
                                            <li>
                                                <details {{ request()->is('core/src*') ? 'open' : ''}}>
                                                    <summary class="text-start text-sorme">
                                                        Src
                                                    </summary>
                                                    <ul>
                                                        <li class="text-start">
                                                            <a href="{{ url('core/src/main') }}" class="{{ request()->is('core/src/main') ? 'text-info' : 'text-off' }}">
                                                                main.c
                                                            </a>
                                                        </li>
                                                        <li class="text-start">
                                                            <a href="{{ url('core/inc/stm32f1xx_hal_msp') }}" class="{{ request()->is('core/src/stm32f1xx_hal_msp') ? 'text-info' : 'text-off' }}">
                                                                stm32f1xx_hal_msp.c
                                                            </a>
                                                        </li>
                                                        <li class="text-start">
                                                            <a href="{{ url('core/src/stm32f1xx_it') }}" class="{{ request()->is('core/src/stm32f1xx_it') ? 'text-info' : 'text-off' }}">
                                                                stm32f1xx_it.c
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </details>
                                            </li>
                                        </ul>
                                    </details>
                                </li>
                                <li><details><summary class="text-start text-sorme">Debug</summary></details></li>
                                <li><details><summary class="text-start text-sorme">Drivers</summary></details></li>
                                <li class="text-start text-off"></li>
                                <li class="text-start text-off"></li>
                                <li class="text-start text-off"></li>
                                <li class="text-start text-off">.cproject</li>
                                <li class="text-start text-off">.mxproject</li>
                                <li class="text-start text-off">.project</li>
                                <li class="text-start text-off">LED_STM32F103.ioc</li>
                                <li class="text-start text-off">STM32F103C6TX_FLASH.ld</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Prism.js -->
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-c.min.js"></script>

<!-- Copy button -->
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/plugins/toolbar/prism-toolbar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/prismjs@1.29.0/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>

</body>
</html>