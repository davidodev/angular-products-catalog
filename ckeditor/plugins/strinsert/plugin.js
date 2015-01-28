/**
 * @license Copyright © 2013 Stuart Sillitoe <stuart@vericode.co.uk>
 * This work is mine, and yours. You can modify it as you wish.
 *
 * Stuart Sillitoe
 * stuartsillitoe.co.uk
 *
 */

CKEDITOR.plugins.add('strinsert',
{
	requires : ['richcombo'],
	init : function( editor )
	{
	     
	     var strings = [];
	     
          jQuery.ajax({
                    url: 'index.php?t=content&action=get-categories&noheader=true&type=slider',
                    dataType: 'json',
                    data: '',
                    beforeSend: function(jqXHR, settings) {
                        
                    },
                    success: function(data, textStatus, jqXHR) {
                         if(data.success) {
                              
                              
                              var length = data.data.length,
                                  element = null;
                                  
                              for (var i = 0; i < length; i++) {
                                   
                                name = data.data[i]['name'];
                                id   = data.data[i]['id'];
                                
                                strings.push(['<strong class=fck-shortcode>' + '[SLIDER id='+ id +' name='+ name +']' + '</strong>', name, name]);

                              }
                              
                              //alert(data.data[0]['name']);
                              
                         }
                        
                    }
          });
	     
		//  array of strings to choose from that'll be inserted into the editor
		//var strings = [];
		//strings.push(['@@slider-1@@', 'Slider 1', 'Slider 1']);
		//strings.push(['@@slider-2@@', 'Slider 2', 'Slider 2']);
		//strings.push(['@@slider-3@@', 'Slider 3', 'Slider 3']);
          
          

		// add the menu to the editor
		editor.ui.addRichCombo('strinsert',
		{
			label: 		'Slider',
			title: 		'Slider',
			voiceLabel: 'Slider',
			className: 	'cke_format',
			multiSelect:false,
			panel:
			{
				css: [ editor.config.contentsCss, CKEDITOR.skin.getPath('editor') ],
				voiceLabel: editor.lang.panelVoiceLabel
			},

			init: function()
			{
				this.startGroup( "Slider" );
				for (var i in strings)
				{
					this.add(strings[i][0], strings[i][1], strings[i][2]);
				}
			},

			onClick: function( value )
			{
				editor.focus();
				editor.fire( 'saveSnapshot' );
				editor.insertHtml(value);
				editor.fire( 'saveSnapshot' );
			}
		});
	}
});