const accept = document.querySelector('.accept');
const card = document.querySelector('.card');
const choseCardPayment = document.querySelector('.addPayment');
const choseCryptoPayment = document.querySelector('.addCrypto');
const crypto = document.querySelector('.payment-method-crypto');
const cryptoInfo = document.querySelector('.crypto');

const withdrawButton = document.querySelector('.withdraw-btn');
const withdrawCard = document.querySelector('.withdrawCrd');
const acceptModal = document.querySelector('.withdraw-request-accepted');
const acceptWithdraw = document.querySelector('.acceptWithdraw');
const operationDetails = document.querySelector('.operation_details');
const amountValue = document.querySelector('.amountValue');
const amount = document.querySelector('.amount');
const acceptOperation = document.querySelector('.acceptOperation');
const whereWallet = document.querySelector('.where');
const fromWallet = document.querySelector('.from');
const whereEndOperation = document.querySelector('.whereEndOperation');
const fromEndOperation = document.querySelector('.fromEndOperation');
const acceptWallets = document.querySelector('.acceptWallets');
const balance = document.querySelector('.balanceww');

const errorBalance = document.querySelector('.errorBalance');
function hideBlocks() {
  crypto.style.display = 'none';
  card.style.display = 'none';
  cryptoInfo.style.display = 'none';
}
if (crypto) {
  hideBlocks();
  choseCardPayment.addEventListener('click', e => {
    card.style.display = 'block';
  });
  accept.addEventListener('click', e => {
    const cantPay = document.createElement('h4');
    cantPay.style.color = 'red';
    cantPay.style.fontSize = '20px';
    cantPay.style.marginTop = '20px';
    cantPay.textContent = 'This payment method is not available in your region';
    card.append(cantPay);
    crypto.style.display = 'block';
  });
  choseCryptoPayment.addEventListener('click', e => {
    cryptoInfo.style.display = 'block';
    window.scrollBy(0, 400);
  });
}
if (withdrawCard) {
  withdrawButton.addEventListener('click', () => {
    const cantPay = document.createElement('h4');
    cantPay.style.color = 'red';
    cantPay.style.fontSize = '20px';
    cantPay.style.marginTop = '20px';
    cantPay.textContent = 'This payment method is not available in your region';
    withdrawCard.append(cantPay);
  });
}

if (operationDetails) {
  const userBalance = balance.textContent.slice(
    9,
    balance.textContent.length - 1
  );
  console.log(userBalance);
  operationDetails.style.display = 'none';
  errorBalance.style.display = 'none';
  acceptWallets.addEventListener('click', e => {
    if (!whereWallet.value || !fromWallet.value) {
      alert('Enter the wallet');
    } else {
      whereEndOperation.value = whereWallet.value;
      fromEndOperation.value = fromWallet.value;
      whereEndOperation.setAttribute('readonly', true);
      fromEndOperation.setAttribute('readonly', true);
    }
  });
  acceptOperation.addEventListener('click', e => {
    if (!whereWallet.value || !fromWallet.value || !amountValue.value) {
      alert('Fill in all fields');
    } else if (Number(userBalance) < Number(amountValue.value)) {
      errorBalance.style.display = 'block';
      errorBalance.textContent = 'Insufficient funds';
      errorBalance.style.color = 'red';
    } else {
      amount.value = amountValue.value + '₮';
      amount.setAttribute('readonly', true);
      operationDetails.style.display = 'block';
    }
  });
  acceptWithdraw.addEventListener('click', e => {
    acceptModal.style.display = 'block';
  });
}
