const articleList = []; // Dans une véritable application, cette liste serait remplie d'articles.
const maxKudos = 5;

function calculateTotalKudos(articles) {
  let totalKudos = 0;

  for (let article of articles) {
    totalKudos += article.kudos;
  }

  return totalKudos;
}

const output = `
  <p>Nombre maximum de kudos que vous pouvez donner à un article : ${maxKudos}</p>
  <p>Total des kudos déjà attribués à tous les articles : ${calculateTotalKudos(articleList)}</p>
`;

document.write(output);

/*

Dans ce fichier JS, la refactorisation est surtout centré sur le nommage des variables qui pour moi peut porter à confusion :
kudos est affiché deux fois on peut le remplacer par une const maxKudos et une variable let totalKudos par exemple.
Enfin j'ai mis l'output dans une const à la fin car plus lisible.

*/
