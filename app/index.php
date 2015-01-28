<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Katalog</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
</head>
<body>


<div ng-app="catalog" id="catalog-wrap">
  <div ui-view ></div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../ckeditor/ckeditor.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js"></script>
<script src="../bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
<script src="assets/js/notify.min.js"></script>

<script src="../bower_components/angularpagination/dirPagination.js"></script>
<script src="../bower_components/ui-sortable-master/src/sortable.js"></script>
<script src="../bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
<script src="../dev/initCatalog.js"></script>

<script src="../dev/modules/directives/ng-ckeditor.js"></script>
<script src="../dev/modules/directives/ng-repeat-tree.js"></script>
<script src="../dev/modules/directives/modal-resize.js"></script>
<script src="../dev/modules/directives/ng-repeat-categories.js"></script>
<script src="../dev/modules/directives/add-photo.js"></script>

<script src="../dev/modules/controllers/products.js"></script>
<script src="../dev/modules/controllers/product.js"></script>
<script src="../dev/modules/controllers/categories.js"></script>
<script src="../dev/modules/controllers/category.js"></script>

<script src="../dev/modules/filters/products.js"></script>
<script src="../dev/modules/filters/categories.js"></script>

<script src="../dev/modules/services/product.js"></script>
<script src="../dev/modules/services/category.js"></script>
</body>