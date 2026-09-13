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
                <div class="col-lg-3" dir="ltr">
                    <div class="profile-sidebar">
                        <div class="border rounded-3 py-3 file-explorer">
                            <div class="file-explorer-title">پروژه LED_STM32F103</div>
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