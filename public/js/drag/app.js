(function () {
	'use strict';

	var byId = function (id) { return document.getElementById(id); },

		loadScripts = function (desc, callback) {
			var deps = [], key, idx = 0;

			for (key in desc) {
				deps.push(key);
			}

			(function _next() {
				var pid,
					name = deps[idx],
					script = document.createElement('script');

				script.type = 'text/javascript';
				script.src = desc[deps[idx]];

				pid = setInterval(function () {
					if (window[name]) {
						clearTimeout(pid);

						deps[idx++] = window[name];

						if (deps[idx]) {
							_next();
						} else {
							callback.apply(null, deps);
						}
					}
				}, 30);

				document.getElementsByTagName('head')[0].appendChild(script);
			})()
		},

		console = window.console;


	if (!console.log) {
		console.log = function () {
			alert([].join.apply(arguments, ' '));
		};
	}


	Sortable.create(byId('add_zone'), {
		group: "words",
		animation: 150,
		onAdd: function (evt){ console.log('onAdd.bar:', evt.from); add_new_element(evt.item); },
		onUpdate: function (evt){ console.log('onUpdate.bar:', evt.item); },
		onRemove: function (evt){ console.log('onRemove.bar:', evt.item); },
		onStart:function(evt){ console.log('onStart.foo:', evt.item);},
		onEnd: function(evt){ console.log('onEnd.foo:', evt.item);}
	});
})();
var elementsObj = [];

function add_new_element(item){
    row_count++;
    formObj[row_count] = 1;
    $( add_empty_row(row_count, item) ).insertBefore( "#row_add" );
    $( "#add_zone > li" ).remove();

    init_drop_zone("1_"+row_count)
  }

  function init_drop_zone(id)
  {
    Sortable.create(document.getElementById('drop_zone_'+id), {
      group: "words",
      animation: 150,
      onAdd: function (evt){ console.log('onAdd.test:', evt.item.getElementsByClassName("form-control")); },
      onUpdate: function (evt){ console.log('onUpdate.possible:', evt.item); },
      onRemove: function (evt){ console.log('onRemove.possible:', evt.item); },
      onStart:function(evt){ console.log('onStart.possible:', evt.item);},
      onEnd: function(evt){ console.log('onEnd.possible:', evt.item);}
    });
  }

  function delete_row(id)
  {
    $(".row_"+id+"_list").each(function( index ) {
      $( this ).children().each(function( index ) {
        $("#possible").append( '<li>' + $( this ).html() + '</li>');
      });
    });
    $("#row_"+id).remove();
  }

function add_empty_row(id, item){
  var html = '';
    html += '                  <div id="row_'+id+'" class="view view-first">';
    html += '                          <div class="mask">';
    html += '                          <div class="tools tools-bottom">';
    html += '                            <a onClick="one_column_row('+id+')"><i class="fa fa-reorder"></i></a>';
    html += '                            <a onClick="two_column_row('+id+')"><i class="fa fa-th-large"></i></a>';
    html += '                            <a onClick="three_column_row('+id+')"><i class="fa fa-th"></i></a>';
    html += '                            <a onClick="delete_row('+id+')"><i class="fa fa-times"></i></a>';
    html += '                          </div>';
    html += '                      </div>';
    html += '                <div id="cols_'+id+'">';
    html += '                  <div id="col_1_'+id+'" class="col-md-12 col-sm-12 col-xs-12 form-group">';
    html += '                  <ul id="drop_zone_1_'+id+'" class="drag-n-drop-ul row_'+id+'_list">';
    html +=                       item.outerHTML;
    html += '                    </ul>';
    html += '                  </div>';
    html += '                </div>';
    html += '             </div>';

    return html;
}
function get_row_elements(id)
{
    var result = [];
    $( "#cols_" + id + " ul" ).each(function(i){
         result.push($(this).html());
      });
    return result;
}
function one_column_row(id)
{
    var rowElements = get_row_elements(id);
    var html = '';
    html += '      <div id="cols_'+id+'">';
    html += '        <div id="col_1_'+id+'" class="col-md-12 col-sm-12 col-xs-12 form-group">';
    html += '        <ul id="drop_zone_1_'+id+'" class="drag-n-drop-ul row_'+id+'_list">';
    html +=             rowElements.join(" ");
    html += '          </ul>';
    html += '        </div>';
    html += '      </div>';

    $('#cols_'+id).replaceWith( html );
    init_drop_zone('1_' + id);
    formObj[id] = 1;
}

function two_column_row(id)
{
    var rowElements = get_row_elements(id);
    var html = '';
    html += '      <div id="cols_'+id+'">';
    html += '        <div id="col_1_'+id+'" class="col-md-6 col-sm-12 col-xs-12 form-group">';
    html += '           <ul id="drop_zone_1_'+id+'" class="drag-n-drop-ul row_'+id+'_list">';
    if (rowElements[0] != undefined) {
        html +=             rowElements[0];
    }
    if (rowElements[2] != undefined) {
        html +=             rowElements[2];
    }
    html += '          </ul>';
    html += '        </div>';
    html += '        <div id="col_2_'+id+'" class="col-md-6 col-sm-12 col-xs-12 form-group">';
    html += '           <ul id="drop_zone_2_'+id+'" class="drag-n-drop-ul row_'+id+'_list">';
    if ( rowElements[1] != undefined ) {
        html +=             rowElements[1];
    }
    html += '          </ul>';
    html += '        </div>';
    html += '      </div>';

    $('#cols_'+id).replaceWith( html );
    init_drop_zone('1_' + id);
    init_drop_zone('2_' + id);
    formObj[id] = 2;
}

function three_column_row(id)
{
    var rowElements = get_row_elements(id);
    var html = '';
    html += '      <div id="cols_'+id+'">';
    html += '        <div id="col_1_'+id+'" class="col-md-4 col-sm-12 col-xs-12 form-group">';
    html += '           <ul id="drop_zone_1_'+id+'" class="drag-n-drop-ul row_'+id+'_list">';
    if (rowElements[0] != undefined) {
        html +=             rowElements[0];
    }
    html += '          </ul>';
    html += '        </div>';
    html += '        <div id="col_2_'+id+'" class="col-md-4 col-sm-12 col-xs-12 form-group">';
    html += '           <ul id="drop_zone_2_'+id+'" class="drag-n-drop-ul row_'+id+'_list">';
    if (rowElements[1] != undefined) {
        html +=             rowElements[1];
    }
    html += '          </ul>';
    html += '        </div>';
    html += '        <div id="col_3_'+id+'" class="col-md-4 col-sm-12 col-xs-12 form-group">';
    html += '           <ul id="drop_zone_3_'+id+'" class="drag-n-drop-ul row_'+id+'_list">';
    if (rowElements[2] != undefined) {
        html +=             rowElements[2];
    }
    html += '          </ul>';
    html += '        </div>';
    html += '      </div>';

    $('#cols_'+id).replaceWith( html );
    init_drop_zone('1_' + id);
    init_drop_zone('2_' + id);
    init_drop_zone('3_' + id);
    formObj[id] = 3;
}
