<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
  <div id="header">
  <img align="left" src="#" height="100px">
  <img align="right" src="#" height="100px"><br></br>
  </div>
  <hr>
</body>

<body>

<div id="app">
  <div class="row">
    <div class="col-lg-2">
      <div class="col-lg-10">
        <div class="panel panel-default">
            <h4><center><div class="panel-heading"></div></center></h4>
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <form role="form">
                      <div class="form-group">
                         <div class="form-group">

<style>
  table 
  {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
  }

  td, th 
  {
      border: 1px solid #A569BD;
      text-align: left;
      padding: 8px;
  }

  tr:nth-child(even) 
  {
    background-color: #A569BD;
  }
</style>


<form>
<table>
  
  <tbody><tr>
    <td>Titulo:</td>
    <td>{{$entry->title}}</td>
  </tr>
  <tr>
    <td>Sinonimo:</td>
    <td>{{$entry->synonym}}</td>
  </tr>
  <tr>
    <td>Distribucion</td>
    <td>{{$entry->distribution}}</td>
  </tr>
  <tr>
    <td>Descrpcion</td>
    <td>{{$entry->description}}</td>
  </tr>
</tbody></table>

</form>

<br/>
<br/>
<center>
  <form>
    <img src="https://verdecora.es/blog/wp-content/uploads/2018/01/floracion-orquideas-rapidamente.jpg" height="200px" style="border-style:dotted;border-width:1px;">
  </form>
</center>

<div style="text-align: center">
        <p><strong>Realizado por: Ing. FernandoPoblano</strong></p>
        <p><strong>Flores finas de Teya S.P.R de R.L</strong></p>
        <p><strong>Hacienda Teya, Kanasin, Yucatan, Mexico</strong></p>
        <p><strong>SEMARNAT-UMA-VIV-0163-YUC-09</strong></p>
</div>
</body>
</html>