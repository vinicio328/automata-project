<!DOCTYPE doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1" name="viewport">
	<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet"/>
	<link href="{{ asset('css/open-icon/css/open-iconic-bootstrap.min.css')}}" rel="stylesheet"/>
	<script src="{{ asset('js/jquery-3.1.1.js') }}" type="text/javascript">
	</script>
	<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript">
	</script>
	<script src="{{ asset('js/angular.min.js') }}" type="text/javascript">
	</script>
	<script src="{{ asset('js/angular-app.js') }}" type="text/javascript">
	</script>
	<style type="text/css">
		body {
			background-color: gray;	 
		}

		.btn-file {
		    position: relative;
		    overflow: hidden;
		}
		.btn-file input[type=file] {
		    position: absolute;
		    top: 0;
		    right: 0;
		    min-width: 100%;
		    min-height: 100%;
		    font-size: 100px;
		    text-align: right;
		    filter: alpha(opacity=0);
		    opacity: 0;
		    outline: none;
		    background: white;
		    cursor: inherit;
		    display: block;
		}

		.divisor .list-group-item {
			border: none;
		}

		.divisor .col-4:not(:last-child) {
		    border-right: 1px solid #ccc;
		}
	</style>
	<title>
		@yield('title')
	</title>

</meta>
</meta>
</head>
<body ng-app="app">
	<div class="container-fluid" ng-controller="AutomataController">
		<nav class="navbar navbar navbar-dark bg-dark  sticky-top" >
		  <h2 class="navbar-brand">
		  	AFN <span class="oi oi-transfer"></span> AFD
		  </h2>
			<img src="{{ asset('logo-1.png') }}" height="50">
		</nav>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<form>
							<div class="form-group">
							  <label for="formGroupExampleInput">Seleccione archivo <i>.txt</i></label>
							  <div class="input-group">
					            <span class="input-group-btn">
					                <span class="btn btn-outline-primary btn-file">
					                    <span class="oi oi-data-transfer-upload" style="height: 19px; margin-top: 4px; "></span> <input type="file" id="imgInp" ng-file-select="onFileSelect($files)">
					                </span>
					            </span>
					            <input type="text" class="form-control" readonly>
					        </div>
							</div>
							
							
						</form>
					</div>
				</div>
				<br/>
				<div class="row">
					<div class="col-md-4">
						<div class="card" style="min-height: 360px;">
							<div class="card-header">
								Txt
							</div>
							<div class="card-body"  >
								<div class="form-group">
									<textarea class="form-control" disabled="disabled" id="exampleFormControlTextarea1" ng-value="textSrc" rows="10">
									</textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 ">
						<div class="card"  style="min-height: 360px;">
							<div class="card-header">
								Quintupla
							</div>
							<div class="card-body text-center divisor">
								<div class="row">
									<div class="col-4">
										<h5>Q</h5>
										<ul class="list-group">
											<li class="list-group-item" ng-repeat="estado in estados">
												<% estado %>
											</li>
										</ul>
									</div>
									<div class="col-4">
										<h5>F</h5>
										<ul class="list-group">
											<li class="list-group-item" ng-repeat="letra in alfabeto">
												<% letra %>
											</li>
										</ul>
									</div>
									<div class="col-4">
										<h5>A</h5>
										<ul class="list-group">
											<li class="list-group-item" ng-repeat="estado in estadosAceptacion">
												<% estado %>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 ">
						<div class="card" style="min-height: 360px;">
							<div class="card-header">
								Funcion Transicion
							</div>
							<div class="card-body"  >
								<table class="table">
									<thead>
										<tr>
										  <th scope="col">Estado</th>
										  <th scope="col" ng-repeat="letra in alfabeto"><% letra %></th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="estado in afn">
											<td>
												<% estado.identifier %>
											</td>
											<td ng-repeat="transicion in estado.transiciones track by $index">
												<% transicion.join(', ') %>
											</td>
											
										</tr>
									</tbody>
								</table>
							</div>

						</div>
					</div>

				</div>
				<hr/>
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								AFD
							</div>
							<div class="card-body">
								<div class="col">
									Q: { <span ng-repeat="estado in transD track by $index"><% estado.identifier | uppercase %><span ng-if="!$last">, </span> </span> }
								</div>
								<div class="col">
									F: {  <span  ng-repeat="letra in alfabeto" ng-if="letra != 'e'"><% letra %><span ng-if="!$last">, </span> </span> }
								</div>
								<div class="col">A: { <span ng-repeat="estado in transD track by $index" ng-if="estado.estadoAceptacion"><% estado.identifier | uppercase %><span ng-if="!$last">,</span> </span> }</div>
							</div>
						</div>
						<br/>
						<div class="card">
							<div class="card-header">
								Validar Cadena
							</div>
							<div class="card-body">
								<form>
									<div class="input-group">
										<input type="text" name="cadena" class="form-control" ng-change="esCadena()" ng-model-options='{ debounce: 1000 }' ng-model="cadena">

									</div>
									<span ng-if="esCadenaAceptacion">
										<span class="oi oi-check"></span>
										Es Cadena de Aceptacion
										</span>
									<span ng-if="!esCadenaAceptacion">
									<span class="oi oi-circle-x"></span>
									No es Cadena de Aceptacion
									</span>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								Estados
							</div>
							<div class="card-body">
								<table class="table">
									<thead>
										<tr>
										  <th scope="col">Estado</th>
										  <th scope="col" ng-repeat="letra in alfabeto" ng-if="letra != 'e'"><% letra %></th>
										  <th scope="col">Composicion</th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="estado in transD">
											<td>
												<% estado.identifier | uppercase %>
											</td>
											<td ng-repeat="transicion in estado.transiciones track by $index">
												<% transicion | uppercase %>
											</td>
											<td><% estado.composicion.join(', ') %></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
			
		</div>
	</div>
	<script type="text/javascript">

		$(document).ready( function() {
		    	$(document).on('change', '.btn-file :file', function() {
				var input = $(this),
					label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [label]);
				});

				$('.btn-file :file').on('fileselect', function(event, label) {
				    
				    var input = $(this).parents('.input-group').find(':text'),
				        log = label;
				    
				    if( input.length ) {
				        input.val(log);
				    } else {
				        if( log ) alert(log);
				    }
			    
				}); 	
			});
	</script>


</body>
</html>