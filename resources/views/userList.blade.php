@extends('layouts.default')
@section('content')

	<div class="row">
		<div class="col-lg-12">
			@include('includes.alert')


			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">


						<div class="panel-heading">

							<h3 class="panel-title">{!!$title!!}</h3>
							
						</div><br>



						<div class="panel-body">
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">

									<table class="table table-striped table-bordered" id="datatable">
										<thead>
										<tr>
											<th>Serial</th>
											<th>name</th>
											<th>Profile pic</th>
											<th>City</th>

										</tr>
										</thead>
										<tbody>
										<?php $cnt = 1; ?>
										@foreach ($users as $user)
											<tr>
												<td><?php echo $cnt; $cnt++;?></td>
												<td>{!! $user->name !!}</td>
												<td>
													<img class="img-circle" src="{!! asset($user->profile_pic) !!}" alt="photo" style="width:50px;height:50px; ">
												</td>
												<td>{!! $user->city !!}</td>
											</tr>
										@endforeach
										</tbody>
									</table>


								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>





@stop


@section('style')

	{!! Html::style('assets/datatables/jquery.dataTables.min.css') !!}

	<style>
		.img-circle {
			border-radius: 50%;
		}
	</style>
@stop


@section('script')

	{!! Html::script('assets/datatables/jquery.dataTables.min.js') !!}
	{!! Html::script('assets/datatables/dataTables.bootstrap.js') !!}




	//for Datatable
	<script type="text/javascript">

		$(document).ready(function() {
			$('#datatable').dataTable();
		});
	</script>





@stop







