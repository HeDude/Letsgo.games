const cards = document.querySelectorAll( '.memory-card' );
const next_game = document.querySelector( '.next_form' );

let hasFlippedCard = false;
let lockBoard = false;
let firstCard, secondCard;
let cardCounter = 0;

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
  }, 1500 );
  cardCounter <= 0 ? show_next_game() : false;
}

function unflipCards ()
{
  lockBoard = true;

  setTimeout( () =>
  {
    firstCard.classList.remove('flip');
    secondCard.classList.remove('flip');
    resetBoard();
  }, 1500);
}

function resetBoard ()
{
  [hasFlippedCard, lockBoard] = [false, false];
  [firstCard, secondCard] = [null, null];
}

function show_next_game ()
{
  cards.forEach( card =>
  {
    card.style.display = 'none';
  } );
  next_game.style.display = 'flex';
}

( function shuffle ()
{
  cards.forEach( card =>
  {
    let randomPos = Math.floor(Math.random() * 40 );
    card.style.order = randomPos;
  });
})();

cards.forEach( card =>
{
  card.addEventListener( 'click', flipCard );
  cardCounter++;
});
