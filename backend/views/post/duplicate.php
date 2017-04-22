

<?php
    use yii\helpers\Html;
?>

<div class="h1 text-center">Duplicated posts Titles and Description </div>
<hr>
<div class="container">
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th>Post_id</th>
<th>Post_title</th>
<th>Post_Description</th>
</tr>
</thead>
<tbody>
<?php
foreach ($data as $model) {
	echo '<tr>';
	echo '<td>'.$model->post_id.'</td>';
	echo '<td>'.$model->post_title.'</td>';
	echo '<td>'.$model->post_description.'</td>';
	echo '</tr>';
}

?>
</tbody>
</table>
</div>
</div>
</div>