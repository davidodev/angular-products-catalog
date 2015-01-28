/**
 * @license Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
     // Define changes to default configuration here. For example:
     // config.language = 'fr';
     // config.uiColor = '#AADC6E';
     
     //kcfinder config
     config.filebrowserBrowseUrl = 'ckeditor/filemanager/browse.php?type=files';
     config.filebrowserImageBrowseUrl = 'ckeditor/filemanager/browse.php?type=images';
     config.filebrowserFlashBrowseUrl = 'ckeditor/filemanager/browse.php?type=flash';
     config.filebrowserUploadUrl = 'ckeditor/filemanager/upload.php?type=files';
     config.filebrowserImageUploadUrl = 'ckeditor/filemanager/upload.php?type=images';
     config.filebrowserFlashUploadUrl = 'ckeditor/filemanager/upload.php?type=flash';
     config.height = 350;
     //config.extraPlugins = 'strinsert,tabs';

     //default toolbar
     /*config.toolbar =
     [
         { name: 'document',    items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
         { name: 'clipboard',   items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
         { name: 'editing',     items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
         { name: 'forms',       items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
         '/',
         { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
         { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
         { name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
         { name: 'insert',      items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ] },
         '/',
         { name: 'styles',      items : [ 'Styles','Format','Font','FontSize' ] },
         { name: 'colors',      items : [ 'TextColor','BGColor' ] },
         { name: 'tools',       items : [ 'Maximize', 'ShowBlocks','-','About' ] }
     ];*/
    
    // zmienić również w js/ng-ckeditor.js
     config.toolbar =
     [
         { name: 'clipboard',   items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','Undo','Redo' ] },
         { name: 'insert',      items : [ 'Image','Flash','Table','Iframe','SpecialChar','-','Link','Unlink','Anchor','HorizontalRule' ] },
         { name: 'document',    items : [ 'Replace','ShowBlocks' ] },
         { name: 'source',      items : [ 'Source' ] },
         '/',
         { name: 'basicstyles', items : [ 'Bold','Italic','Underline','-','Strike','Subscript','Superscript','-','TextColor','BGColor','-','RemoveFormat'] },
         { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'/*, 'strinsert', 'tabs'*/ ] },

         '/',
         { name: 'styles',      items : [ 'Styles','Format','Font','FontSize' ] }
     ];

};



CKEDITOR.config.toolbar_Basic =
[
     ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','Format']
];
