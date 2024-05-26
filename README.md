<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>REPOSITORIO PRUEBA TÉCNICA IDRD</title>
    <link
      rel="stylesheet"
      href="wp-admin/css/install.css?ver=20100228"
      type="text/css"
    />
  </head>

  <body style="margin-top: 25px">
    <h1 style="text-align: center">REPOSITORIO PRUEBA TÉNICA IDRD</h1>
    <ol>
      <p>
        Los frameworks utilizados en este prueba son los siguientes: vue 3 como
        frontend
      </p>
    </ol>
    <ol>
      <ol>
        <li>Laravel 8.83.27 como backend.</li>
        <li>vue 3 como frontend</li>
      </ol>
    </ol>
    <ol>
      <p>Librearias adicionales para el frontend:</p>
    </ol>
    <ol>
      <ol>
        <li>vuetify</li>
        <li>axios</li>
      </ol>
    </ol>
    <ol>
      <p>
        Para migrar la aplicación en un ambiente local, la url local debe ser no
        debe tener puertos diferentes es decir:
        <a href="http://localhost/" target="_blank">http://localhost/</a>, sin
        puertos se debe realizar los siguientes pasos:
      </p>
    </ol>
    <ol>
      <ol>
        <li>
          Clonar repositorio con el comando:
          <span class="code">
            git clone
            <a target="_blank" href="https://github.com/youlez/IDRD.git  "
              >https://github.com/youlez/IDRD.git</a
            ></span
          >
        </li>
        <li>
          Agregar el archivo <i>.env</i> en la carpeta de <b><i>backend</i></b
          >, colocando los datos de la base de datos:
        </li>
        <textarea
          style="margin: 10px 0px"
          class="code"
          readonly="readonly"
          cols="100"
          rows="7"
        >
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=idrd
DB_USERNAME=root
DB_PASSWORD=
            </textarea
        >
        <li>
          Abrir una terminal de la carpeta clonada, entrar a la carpeta
          <b><i>backend</i></b> y ejecutar el comando:
          <span class="code">composer update</span>
        </li>
        <li>
          En la misma terminal devolver una carpeta y entrar a la carpeta
          <b><i>frontend</i></b> y ejecutar el comando:
          <span class="code">npm install</span>
        </li>
        <li>
          Como es un ambiente local se puede ejecutar el comando:
          <span class="code">npm run serve</span>
        </li>
        <li>
          Finalmente, desde el navegador entrar a la url que nos aparece en la
          terminal.
        </li>
        <textarea
          style="margin: 10px 0px"
          class="code"
          readonly="readonly"
          cols="100"
          rows="4"
        >
Ejemplo:
- Local:   http://localhost:8080/
- Network: http://192.168.1.9:8080/
          </textarea
        >
      </ol>
    </ol>
  </body>
</html>
<style>
  html {
    background: #f0f0f1;
    margin: 0 20px;
  }

  body {
    background: #fff;
    border: 1px solid #c3c4c7;
    color: #3c434a;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
      Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    margin: 140px auto 25px;
    padding: 20px 20px 10px;
    max-width: 700px;
    -webkit-font-smoothing: subpixel-antialiased;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
  }

  a {
    color: #2271b1;
  }

  a:hover,
  a:active {
    color: #135e96;
  }

  a:focus {
    color: #043959;
    box-shadow: 0 0 0 1px #4f94d4, 0 0 2px 1px rgba(79, 148, 212, 0.8);
  }

  h1,
  h2 {
    border-bottom: 1px solid #dcdcde;
    clear: both;
    color: #646970;
    font-size: 24px;
    padding: 0 0 7px;
    font-weight: 400;
  }

  h3 {
    font-size: 16px;
  }

  p,
  li,
  dd,
  dt {
    padding-bottom: 2px;
    font-size: 14px;
    line-height: 1.5;
  }

  code,
  .code {
    font-family: Consolas, Monaco, monospace;
  }

  ul,
  dl {
    padding: 5px 5px 5px 22px;
  }

  ol {
    padding: 0px 15px;
  }

  a img {
    border: 0;
  }
  abbr {
    border: 0;
    font-variant: normal;
  }

  fieldset {
    border: 0;
    padding: 0;
    margin: 0;
  }

  label {
    cursor: pointer;
  }

  #logo {
    margin: -130px auto 25px;
    padding: 0 0 25px;
    width: 84px;
    height: 84px;
    overflow: hidden;
    background-image: url(../images/w-logo-blue.png?ver=20131202);
    background-image: none, url(../images/wordpress-logo.svg?ver=20131107);
    background-size: 84px;
    background-position: center top;
    background-repeat: no-repeat;
    color: #3c434a; /* same as login.css */
    font-size: 20px;
    font-weight: 400;
    line-height: 1.3em;
    text-decoration: none;
    text-align: center;
    text-indent: -9999px;
    outline: none;
  }

  .step {
    margin: 20px 0 15px;
  }
  .step,
  th {
    text-align: left;
    padding: 0;
  }
  .language-chooser.wp-core-ui .step .button.button-large {
    font-size: 14px;
  }
  textarea {
    border: 1px solid #dcdcde;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
      Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
    width: 100%;
    box-sizing: border-box;
  }

  .form-table {
    border-collapse: collapse;
    margin-top: 1em;
    width: 100%;
  }

  .form-table td {
    margin-bottom: 9px;
    padding: 10px 20px 10px 0;
    font-size: 14px;
    vertical-align: top;
  }

  .form-table th {
    font-size: 14px;
    text-align: left;
    padding: 10px 20px 10px 0;
    width: 115px;
    vertical-align: top;
  }

  .form-table code {
    line-height: 1.28571428;
    font-size: 14px;
  }

  .form-table p {
    margin: 4px 0 0;
    font-size: 11px;
  }

  .form-table .setup-description {
    margin: 4px 0 0;
    line-height: 1.6;
  }

  .form-table input {
    line-height: 1.33333333;
    font-size: 15px;
    padding: 3px 5px;
  }

  .wp-pwd {
    margin-top: 0;
  }

  .form-table .wp-pwd {
    display: flex;
    column-gap: 4px;
  }

  .form-table .password-input-wrapper {
    width: 100%;
  }

  input,
  submit {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto,
      Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
  }

  .form-table input[type="text"],
  .form-table input[type="email"],
  .form-table input[type="url"],
  .form-table input[type="password"],
  #pass-strength-result {
    width: 100%;
  }

  .form-table th p {
    font-weight: 400;
  }

  .form-table.install-success th,
  .form-table.install-success td {
    vertical-align: middle;
    padding: 16px 20px 16px 0;
  }

  .form-table.install-success td p {
    margin: 0;
    font-size: 14px;
  }

  .form-table.install-success td code {
    margin: 0;
    font-size: 18px;
  }

  #error-page {
    margin-top: 50px;
  }

  #error-page p {
    font-size: 14px;
    line-height: 1.28571428;
    margin: 25px 0 20px;
  }

  #error-page code,
  .code {
    font-family: Consolas, Monaco, monospace;
  }

  .message {
    border-left: 4px solid #d63638;
    padding: 0.7em 0.6em;
    background-color: #fcf0f1;
  }

  /* rtl:ignore */
  #dbname,
  #uname,
  #pwd,
  #dbhost,
  #prefix,
  #user_login,
  #admin_email,
  #pass1,
  #pass2 {
    direction: ltr;
  }

  /* localization */
  body.rtl,
  .rtl textarea,
  .rtl input,
  .rtl submit {
    font-family: Tahoma, sans-serif;
  }

  :lang(he-il) body.rtl,
  :lang(he-il) .rtl textarea,
  :lang(he-il) .rtl input,
  :lang(he-il) .rtl submit {
    font-family: Arial, sans-serif;
  }

  @media only screen and (max-width: 799px) {
    body {
      margin-top: 115px;
    }
    #logo a {
      margin: -125px auto 30px;
    }
  }

  @media screen and (max-width: 782px) {
    .form-table {
      margin-top: 0;
    }

    .form-table th,
    .form-table td {
      display: block;
      width: auto;
      vertical-align: middle;
    }

    .form-table th {
      padding: 20px 0 0;
    }

    .form-table td {
      padding: 5px 0;
      border: 0;
      margin: 0;
    }

    textarea,
    input {
      font-size: 16px;
    }

    .form-table td input[type="text"],
    .form-table td input[type="email"],
    .form-table td input[type="url"],
    .form-table td input[type="password"],
    .form-table td select,
    .form-table td textarea,
    .form-table span.description {
      width: 100%;
      font-size: 16px;
      line-height: 1.5;
      padding: 7px 10px;
      display: block;
      max-width: none;
      box-sizing: border-box;
    }

    #pwd {
      padding-right: 2.5rem;
    }

    .wp-pwd #pass1 {
      padding-right: 50px;
    }

    .wp-pwd .button.wp-hide-pw {
      right: 0;
    }

    #pass-strength-result {
      width: 100%;
    }
  }

  body.language-chooser {
    max-width: 300px;
  }

  .language-chooser select {
    padding: 8px;
    width: 100%;
    display: block;
    border: 1px solid #dcdcde;
    background: #fff;
    color: #2c3338;
    font-size: 16px;
    font-family: Arial, sans-serif;
    font-weight: 400;
  }

  .language-chooser select:focus {
    color: #2c3338;
  }

  .language-chooser select option:hover,
  .language-chooser select option:focus {
    color: #0a4b78;
  }

  .language-chooser .step {
    text-align: right;
  }

  .screen-reader-input,
  .screen-reader-text {
    border: 0;
    clip: rect(1px, 1px, 1px, 1px);
    -webkit-clip-path: inset(50%);
    clip-path: inset(50%);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
    word-wrap: normal !important;
  }

  .spinner {
    background: url(../images/spinner.gif) no-repeat;
    background-size: 20px 20px;
    visibility: hidden;
    opacity: 0.7;
    filter: alpha(opacity=70);
    width: 20px;
    height: 20px;
    margin: 2px 5px 0;
  }

  .step .spinner {
    display: inline-block;
    vertical-align: middle;
    margin-right: 15px;
  }

  .button.hide-if-no-js,
  .hide-if-no-js {
    display: none;
  }

  /**
 * HiDPI Displays
 */
  @media print,
    (-webkit-min-device-pixel-ratio: 1.25),
    (min-resolution: 120dpi) {
    .spinner {
      background-image: url(../images/spinner-2x.gif);
    }
  }
</style>

