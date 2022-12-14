<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM task_list where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-task">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-5">
				<div class="form-group">
						<label for="">N° Solicitud: </label>
						<input type="text" class="form-control form-control-sm" name="nsolicitud" value="<?php echo isset($task) ? $task : '' ?>" required>
					</div>
					<div class="form-group">
						<label for="">Titulo breve: </label>
						<input type="text" class="form-control form-control-sm" name="task" value="<?php echo isset($task) ? $task : '' ?>" required>
					</div>
					<div class="form-group">
						<label for="">Asignar a: </label>
						<select name="employee_id" id="employee_id" class="form-control form-control-sm" required="">
							<option value=""></option>
							<?php 
							$employees = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM employee_list order by concat(lastname,', ',firstname,' ',middlename) asc");
							while($row=$employees->fetch_assoc()):
							?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($employee_id) && $employee_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Fecha de Solicitud</label>
						<input type="date" class="form-control form-control-sm" name="due_date" value="<?php echo isset($due_date) ? $due_date : date("Y-m-d") ?>" required>
					</div>
					<div class="form-group">
						<label for="">Fecha de recepción</label>
						<input type="date" class="form-control form-control-sm" name="recepcion_date" value="<?php echo isset($recepcion_date) ? $recepcion_date : date("Y-m-d") ?>" required>
					</div>
					<div class="form-group">
						<label for="">Emisor</label>
						<select name="emisor" id="department" class="form-control form-control-sm" required="">
							<option value=""></option>
							<?php 
							$employees = $conn->query("SELECT * FROM department_list ");
							while($row=$employees->fetch_assoc()):
							?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($department_id) && $department_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['department'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Destino</label>
						<select name="destino" id="department" class="form-control form-control-sm" required="">
							<option value=""></option>
							<?php 
							$employees = $conn->query("SELECT * FROM department_list ");
							while($row=$employees->fetch_assoc()):
							?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($department_id) && $department_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['department'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="">N° Licitacion: </label>
						<input type="text" class="form-control form-control-sm" name="licitacion" value="<?php echo isset($licitacion) ? $licitacion : '' ?>" >
					</div>
					<div class="form-group">
						<label for="">N° Chilecompra: </label>
						<input type="text" class="form-control form-control-sm" name="chilecompra" value="<?php echo isset($chilecompra) ? $chilecompra : '' ?>" >
					</div>
					<div class="form-group">
						<label for="">N° OC Interno: </label>
						<input type="text" class="form-control form-control-sm" name="oc_interno" value="<?php echo isset($oc_interno) ? $oc_interno : '' ?>" >
					</div>
					
				</div>
				<div class="col-md-7 ">
					<div class="form-group">
						<label for="">Descripción: </label>
						<textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
							<?php echo isset($description) ? $description : '' ?>
						</textarea>
						<label for="">Observaciónes: </label>
						<textarea name="observacion" id="" cols="10" rows="5" class="form-control">
							<?php echo isset($observacion) ? $observacion : '' ?>
						</textarea>
					</div>
				</div>
			</div>
		</div>
		
		
	</form>
</div>

<script>
	$(document).ready(function(){

	$('#employee_id').select2({
		placeholder:'Elija funcionario',
		width:'100%'
	})

	$('.summernote').summernote({
        height: 200,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    })
     })
    
    $('#manage-task').submit(function(e){
    	e.preventDefault()
    	start_load()
    	$.ajax({
    		url:'ajax.php?action=save_task',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Datos grabados satisfactoriamente',"Proceso Exitóso");
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
    	})
    })
</script>