// If you wish to reuse this code, go to my CodePen to see isolated CSS/JS/HTML.
// https://codepen.io/lukepchr/pen/EMyBPx

let lock = false;
var notify = (string) => {
let n = $('#notification');
let t = $('#text');
if (!lock){
  lock = true;
  t.text(string);
  n.slideDown('slow');
  setTimeout(function(){
    n.slideUp('slow', function(){lock = false;});
}, 2500);
}
}
