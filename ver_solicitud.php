<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT t.*,concat(e.lastname,', ',e.firstname,' ',e.middlename) as name FROM task_list t inner join employee_list e on e.id = t.employee_id  where t.id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-6">
				<dl>
					<dt><b class="border-bottom border-primary">Solicitud</b></dt>
					<dd><?php echo ucwords($task) ?></dd>
				</dl>
				<dl>
					<dt><b class="border-bottom border-primary">Asignar a</b></dt>
					<dd><?php echo ucwords($name) ?></dd>
				</dl>
			</div>
			<div class="col-md-6">
				<dl>
					<dt><b class="border-bottom border-primary">Fecha de Solicitud</b></dt>
					<dd><?php echo date("m d,Y",strtotime($due_date)) ?></dd>
				</dl>
				<dl>
					<dt><b class="border-bottom border-primary">Fecha de recepción</b></dt>
					<dd><?php echo date("m d,Y",strtotime($recepcion_date)) ?></dd>
				</dl>
				<dl>
					<dt><b class="border-bottom border-primary">Estado</b></dt>
					<dd>
						<?php 
			        	if($status == 0){
					  		echo "<span class='badge badge-info'>Pendiente</span>";
			        	}elseif($status == 1){
					  		echo "<span class='badge badge-primary'>En-Progreso</span>";
			        	}elseif($status == 2){
					  		echo "<span class='badge badge-success'>Completo</span>";
			        	}
			        	?>
					</dd>
				</dl>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<dl>
				<dt><b class="border-bottom border-primary">Descripción</b></dt>
				<dd><?php echo html_entity_decode($description) ?></dd>
			</dl>
			</div>
		</div>
	</div>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
	#post-field{
		max-height: 70vh;
		overflow: auto;
	}
</style>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
</div>