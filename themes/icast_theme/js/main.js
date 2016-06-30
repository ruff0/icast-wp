jQuery(document).ready(function( $ ) {
	console.log( "ready!" );
	$("blockquote").fitText(1.2, { minFontSize: '20px', maxFontSize: '60px' });
	$("h2").fitText(1.3, { minFontSize: '50px', maxFontSize: '120px' });
	// $('blockquote p').textfill();
	Reveal.configure({
      keyboard: {
        13: 'next', // go to the next slide when the ENTER key is pressed
        49: function() {Reveal.slide(0);}, // 1
        50: function() {Reveal.slide(1);}, // 2
        51: function() {Reveal.slide(2);}, // 3
        52: function() {Reveal.slide(3);}, // 4
        53: function() {Reveal.slide(4);}, // 5
        54: function() {Reveal.slide(5);}, // 6
        55: function() {Reveal.slide(6);}, // 7
        56: function() {Reveal.slide(7);}, // 8
        57: function() {Reveal.slide(8);}, // 9
        48: function() {Reveal.slide(9);},  // 0

        //QWERTY
        81: function() {Reveal.slide(10);}, // Q
        87: function() {Reveal.slide(11);}, // W
        69: function() {Reveal.slide(12);}, // E
        82: function() {Reveal.slide(13);}, // R
        84: function() {Reveal.slide(14);}, // T
        89: function() {Reveal.slide(15);}, // Y
        85: function() {Reveal.slide(16);}, // U
        73: function() {Reveal.slide(17);}, // I
        79: function() {Reveal.slide(18);}, // O
        80: function() {Reveal.slide(19);}, // P

        // ASDFG
        65: function() {Reveal.slide(20);}, // A
        83: function() {Reveal.slide(21);}, // S
        68: function() {Reveal.slide(22);}, // D
        70: function() {Reveal.slide(23);}, // F
        71: function() {Reveal.slide(24);}, // G
        72: function() {Reveal.slide(25);}, // H
        74: function() {Reveal.slide(26);}, // J
        75: function() {Reveal.slide(27);}, // K
        76: function() {Reveal.slide(28);} // L

       // 59: function() {Reveal.slide(10);}, //
      }
    });
});
