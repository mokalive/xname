'use strict';

module.exports = function cyrillicToTranslit() {
  const _associations = {
    "а": "a", "А": "A",
    "ә": "a'", "Ә": "A'",
    "б": "b", "Б": "B",
    "в": "v", "В": "V",
    "г": "g", "Г": "G",
    "ғ": "g'", "Ғ": "G'",
    "д": "d", "Д": "D",
    "е": "e", "Е": "E",
    "ё": "i'o", "Ё": "I'O",
    "й": "i'", "Й": "I'",
    "ж": "j", "Ж": "J",
    "з": "z", "З": "Z",
    "и": "i", "И": "I'",
    "і": "i", "І": "I",
    "ю": "i'y'", "Ю": "I'Y'",
    "ң": "n'", "Ң": "N'",
    "к": "k", "К": "K",
    "қ": "q", "Қ": "Q",
    "л": "l", "l": "L",
    "м": "m", "М": "M",
    "н": "n", "Н": "N",
    "о": "o", "О": "O",
    "п": "p", "П": "P",
    "р": "r", "Р": "R",
    "с": "s", "С": "S",
    "т": "t", "Т":" T",
    "у": "y'", "У": "Y'",
    "ф": "f", "Ф": "F",
    "х": "h", "Х": "H",
    "ц": "c", "Ц": "C",
    "ч": "c'", "Ч": "С'",
    "ш": "s'", "Ш": "S'",
    "щ": "s's'", "Щ": "S'S'",
    "ъ": "", "":"",
    "ы": "y", "Ы":"Y",
    "ь": "", "":"",
    "э": "e", "Э":"E",
    "ұ": "u", "Ұ":"U",
    "ү": "u'", "Ү":"U'",
    "ө": "o'", "Ө":"o'",
    "я": "i'a", "Я":"I'A",
  };

  function transform(str, spaceReplacement) {
    if (!str) {
      return "";
    }

    let new_str = "";
    for (let i = 0; i < str.length; i++) {
      let strLowerCase = str[i].toString();
      if (strLowerCase === " " && spaceReplacement) {
        new_str += spaceReplacement;
        continue;
      }
      let new_letter = _associations[strLowerCase];
      if ("undefined" === typeof new_letter) {
        new_str += strLowerCase;
      }
      else {
        new_str += new_letter;
      }
    }
    return new_str;
  }

  return {
    transform: transform
  };
};
