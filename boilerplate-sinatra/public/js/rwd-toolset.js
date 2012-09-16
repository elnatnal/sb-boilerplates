function displayWindowWidth(){
	 var windowWidth = 0;
	// If Chrome 
	if (navigator.userAgent.indexOf("Chrome")!=-1) {
		windowWidth = document.documentElement.clientWidth;
	} 
	// Else if other modern browser
	else if( typeof( window.innerWidth ) == 'number' ) {
		windowWidth = window.innerWidth;
	}
	// Display current window width
	document.getElementById('window-width').innerHTML='Window width = '+windowWidth+'px';
};

function rwdCalc(){
	// Intialize variables
	var target,context,result,option;
	
	var rwdCalculator = document.getElementById('calc-form');
	target=parseFloat(rwdCalculator.rwdTarget.value);
	context=parseFloat(rwdCalculator.rwdContext.value);
	var option = $('input:radio[name=resultsIn]:checked').val();
	
	if (target && context != ''){	
		if (option=="percent")
		{
			result=(target/context)*100;
			rwdCalculator.rwdResult.value=result+'%';
		}
		else if(option=="em")
		{
			result=target/context;
			rwdCalculator.rwdResult.value=result+'em';
		}
	}
}; // End RWD Calc

var rwdToolset ='<form id="calc-form"><a href="#" id="rwd-tgl-btn" class="hideRWD-toolset"></a><a href="#" id="calc-tgl-btn" class="hideCalc"></a><div id="rwd-toolset"><div id="rwd-main"><a href="http://www.brettjankord.com/2012/01/18/rwd-toolset/" target="_blank">RWD TOOLSET</a><div id="window-width"></div></div><div id="calc-options"><strong>Results In:</strong><label for="percent" id="resultsInPercent">% <input id="percent" name="resultsIn" type="radio" value="percent" ></label><label for="em" id="resultsInEMs">EM <input id="em" name="resultsIn" type="radio" value="em" ></label></div><ul id="rwd-calculator"><li><label>Target Size</label><input name="rwdTarget" type="text" id="rwdTarget"></li><li class="calc-symbol">/</li><li><label>Context Size</label><input name="rwdContext" type="text" id="rwdContext"></li><li class="calc-symbol">=</li><li class="results-container"><label>Result</label><input name="rwdResult" type="text" id="rwdResult"></li><li class="submit-container"><input type="submit" value="Calculate" id="rwd-calulator-btn" /></li></ul></div></form>'

$(document).ready(function() {
	$('body').append(rwdToolset);
	
	displayWindowWidth();
	
	$('#rwd-calulator-btn').click(function(){
		rwdCalc();
		return false;
	});
	
	$('#rwd-tgl-btn').click(function(){
		$(this).toggleClass("hideRWD-toolset").toggleClass("showRWD-toolset");
		$('#rwd-toolset').slideToggle();
		return false;
	});
	
	$('#calc-tgl-btn').click(function(){
		$(this).toggleClass("hideCalc").toggleClass("showCalc");
		$('#calc-options, #rwd-calculator').slideToggle();
		return false;
	});
	
	$(window).resize(function() {
		displayWindowWidth();
	});
});