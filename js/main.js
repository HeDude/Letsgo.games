const cards = document.querySelectorAll( '.memory-card' );
const next_playground = document.querySelector( '.next_playground' );

let hasFlippedCard = false;
let lockBoard = false;
let firstCard, secondCard;
let cardCounter = 0;
// let showCardDuration = 5000;
let showCardDuration = 1000;
let numberofCards = 40;
// let requiredMatches = 20;
let requiredMatches = 1;
let removeMatchesDuration = 1500;

function flipCard ()
{
  if ( lockBoard ) return;
  if ( this === firstCard ) return;

  this.classList.add('flip');

  if ( !hasFlippedCard )
  {
    hasFlippedCard = true;
    firstCard = this;
    return;
  }

  secondCard = this;

  checkForMatch();
}

function checkForMatch ()
{
  let isMatch = firstCard.dataset.framework === secondCard.dataset.framework;

  isMatch ? disableCards() : unflipCards();
}

function disableCards ()
{
  lockBoard = true;
  cardCounter -= 2;
  firstCard.removeEventListener('click', flipCard);
  secondCard.removeEventListener( 'click', flipCard );
  setTimeout( () =>
  {
    firstCard.style.visibility = "hidden";
    secondCard.style.visibility = "hidden";
    resetBoard();
  }, removeMatchesDuration );
  cardCounter <= numberofCards - 2 * requiredMatches ? show_next_playground() : false;
}

function unflipCards ()
{
  lockBoard = true;

  setTimeout( () =>
  {
    firstCard.classList.remove('flip');
    secondCard.classList.remove('flip');
    resetBoard();
  }, showCardDuration );
}

function resetBoard ()
{
  [hasFlippedCard, lockBoard] = [false, false];
  [firstCard, secondCard] = [null, null];
}

function show_next_playground ()
{
  cards.forEach( card =>
  {
    card.style.display = 'none';
  } );
  next_playground.style.display = 'flex';
}

( function shuffle ()
{
  cards.forEach( card =>
  {
    let randomPos = Math.floor(Math.random() * numberofCards );
    card.style.order = randomPos;
  });
})();

cards.forEach( card =>
{
  card.addEventListener( 'click', flipCard );
  cardCounter++;
});
