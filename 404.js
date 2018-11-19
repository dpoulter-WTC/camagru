(function() {
	time = 20;
	random = 100;
  open = "<span style='color: white;'>&lt&shy";
  close = "<span style='color: white;'>&gt&shy";
  red = "<span style='color: red;'>";
  white = "<span style='color: white;'>";
  orange = "<span style='color: orange;'>";
  green = "<span style='color: green;'>";
	input_text = "   <span style='color: white;'>&lt&shy!DOCTYPE html&gt&shy\n   " + open + red + "html " + orange + "lang" + white + "=" + green + "&quot&shyen&quot&shy" + close +
  "\n   " + open + red + "head" + close + "\n     " + open + red + "meta " + orange + "charset" + white + "=" + green + "&quot&shyUTF-8&quot&shy" + close +
  "\n     " + open + red + "title" + close + white + "404" + open + "&#47&shy" + red + "title" + close +
  "\n     " + open + red + "script" + orange + " src" + white + "=" + green + "&quot&shy404.js&quot&shy" + close + open + red + "&#47&shyscript" + close +
  "\n   " + open + "&#47&shy" + red + "head" + close +
  "\n   " + open + red + "body" + close +
  "\n     " + open + red + "div " + orange + "class=" + green + "&quot&shypage&quot&shy" + close +
  "\n       " + open + red + "div " + orange + "class=" + green + "&quot&shytop&quot&shy" + close +
  "\n         " + open + red + "div " + orange + "class=" + green + "&quot&shyleft&quot&shy" + close +
  "\n           " + open + red + "p" + close + "404.php -- C:&#92&shyxampp&#92&shyhtdocs&#92&shycamagru -- Atom" + open + red + "&#47&shyp" + close +
  "\n         " + open + red + "&#47&shydiv" + close +
  "\n         " + open + red + "div " + orange + "class=" + green + "&quot&shyright&quot&shy" + close +
  "\n           " + open + red + "a" + orange + " href" + white + "=" + green + "&quot&shyindex.php&quot&shy" + close + "x" + open + red + "&#47&shya" + close +
  "\n         " + open + red + "&#47&shydiv" + close +
  "\n       " + open + red + "&#47&shydiv" + close +
  "\n       " + open + red + "div " + orange + "class=" + green + "&quot&shytop2&quot&shy" + close +
  "\n         " + open + red + "div " + orange + "class=" + green + "&quot&shyleft&quot&shy" + close +
  "\n           " + open + red + "p" + close + "File  Edit  View  Selection  Find  Packages  Help" + open + red + "&#47&shyp" + close +
  "\n         " + open + red + "&#47&shydiv" + close +
    "\n       " + open + red + "&#47&shydiv" + close;

  current = 0;
  function type(){
    // If the current count is larger than the length of the string, then for goodness sake, stop
  	if(current > input_text.length){
      // Write Complete
  		console.log("Complete.");
      // Wait a bit, then do the complete function
  		setTimeout(function(){

  		},3000);

  	}
  	else{
  		console.log(current);
  		current += 1;
      if (input_text.substring(current-1, current) == "<")
      {
        while (input_text.substring(current-1, current) !== '>')
          current += 1;
      }
      if (input_text.substring(current-1, current) == "&")
      {
        current += 1;
        while (input_text.substring(current-1, current) !== '&')
        {
          current += 1;
        }
        current += 3;
      }

      document.getElementById('output').innerHTML = input_text.substring(0,current);
      // Wait ...
  		setTimeout(function(){
        // do the function again, with the newly incremented marker
  			type();
        // Time it the normal time, plus a random amount of sway
  		},time + Math.random()*random);
  	}
  }

  window.addEventListener('load', type, false);
})();
