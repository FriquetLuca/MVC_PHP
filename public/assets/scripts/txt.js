/**
  * Shorthand static class for special string functions.
  */
 export class Txt
 {
     /**
      * A shorthand function to extract a certain number of character from a string. 
      * @param {string} content The string where we want to extract content from.
      * @param {number} index The index from which we start.
      * @param {number} nbrLetters The number of letters to extract.
      * @returns Return a string of nbrLetters characters if there is that many from a starting point.
      */
     static extract(content, index, nbrLetters)
     {
        let result = '';
        for(let i = index; i < content.length; i++)
        {
            if(i >= index + nbrLetters)
            {
                return result;
            }
            result = `${result}${content[i]}`;
        }
        return result;
    }
 }