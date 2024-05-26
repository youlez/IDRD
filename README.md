<h1 style="text-align: center">REPOSITORIO PARA PRUEBA TÉNICA IDRD</h1>
<i>Por: Karent Pinzon</i>
<br>
<p>
  Los frameworks utilizados en este prueba son los siguientes: vue 3 como
  frontend
</p>
<li>Laravel 8.83.27 como backend.</li>
<li>vue 3 como frontend</li>
<br>
<p>Librearias adicionales para el frontend:</p>
<li>vuetify</li>
<li>axios</li>
<br>
<p>
  Para migrar la aplicación en un ambiente local, la url local debe ser no
  debe tener puertos diferentes es decir:
  <a href="http://localhost/" target="_blank">http://localhost/</a>, sin
  puertos se debe realizar los siguientes pasos:
</p>
<li>
  Clonar repositorio con el comando:
</li>
<br>

```
    git clone https://github.com/youlez/IDRD.git
```

<li>
  Agregar el archivo <i>.env</i> en la carpeta de <b><i>backend</i></b
  >, colocando los datos de la base de datos:
</li>
<br>

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=idrd
DB_USERNAME=root
DB_PASSWORD=    
```

<li>
  Abrir una terminal de la carpeta clonada, entrar a la carpeta
  <b><i>backend</i></b> y ejecutar el comando:  
</li>
<br>

```
composer update
```

<li>
  En la misma terminal devolver una carpeta y entrar a la carpeta
  <b><i>frontend</i></b> y ejecutar el comando:
</li>
<br>

```
npm install
```

<li>
  Como es un ambiente local se puede ejecutar el comando:
</li>
<br>

```
npm run serve
```

<li>
  Finalmente, desde el navegador entrar a la url que nos aparece en la
  terminal.
</li>
<br>

<b>Ejemplo:</b>
<br>

```
Ejemplo:
- Local:   http://localhost:8080/
- Network: http://192.168.1.9:8080/
```
