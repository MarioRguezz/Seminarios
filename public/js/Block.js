$(document).ready(function () {

  document.addEventListener('contextmenu', event => event.preventDefault());

    shortcut.add("F12",function() {
    },{
    	'type':'keydown',
    	'propagate':false,
    	'target':document
    });



shortcut.add("Meta+Alt+j",function() {
},{
  'type':'keydown',
  'propagate':false,
  'target':document
});

shortcut.add("Meta+Alt+i",function() {
},{
  'type':'keydown',
  'propagate':false,
  'target':document
});


    shortcut.add("Ctrl+Shift+j",function() {
    },{
    	'type':'keydown',
    	'propagate':false,
    	'target':document
    });



});
