/* String Length */

let txt = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
let length = txt.length;

/* Slice */

let str1 = "Apple, Banana, Kiwi";
let part1 = str.slice(7, 13);

let str2 = "Apple, Banana, Kiwi";
let part2 = str.slice(-12, -6);

/* Substring */

let str = "Apple, Banana, Kiwi";
let part = str.substring(7, 13);

/* Replace */

let text = "Please visit Microsoft!";
let newText = text.replace("Microsoft", "W3Schools");

/* Case Conversion */

let text1 = "Hello World!";
let text2 = text1.toUpperCase();

let text3 = "Hello World!";
let text4 = text1.toLowerCase();

/* Concat */

let text5 = "Hello";
let text6 = "World";
let text7 = text5.concat(" ", text6);
let text8 = text5 + ' ' + text6;

/* padStart */

let text9 = "5";
let padded = text.padStart(4,"0");