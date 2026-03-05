<style>
@import url("https://fonts.googleapis.com/css?family=Roboto");
/* offset-x > | offset-y ^| blur-radius | spread-radius | color */
@keyframes pulse {
  0% {
    transform: scale(1, 1);
  }
  50% {
    opacity: 0.3;
  }
  100% {
    transform: scale(1.45);
    opacity: 0;
  }
}
.pulse {
  -webkit-animation-name: pulse;
  animation-name: pulse;
}

.nav-bottom {
  display: flex;
  flex-direction: row;
  justify-content: flex-end;
  align-content: flex-end;
  width: auto;
  height: auto;
  position: fixed;
  z-index: 8;
  bottom: 0px;
  right: 0px;
  padding: 5px;
  margin: 0px;
}
@media (max-width: 360px) {
  .nav-bottom {
    width: 320px;
  }
}

.whatsapp-button {
  display: flex;
  justify-content: center;
  align-content: center;
  width: 60px;
  height: 60px;
  z-index: 8;
  transition: 0.3s;
  margin: 10px;
  padding: 7px;
  border: none;
  outline: none;
  cursor: pointer;
  border-radius: 50%;
  background-color: white;
  /* offset-x > | offset-y ^| blur-radius | spread-radius | color */
  -webkit-box-shadow: 1px 1px 6px 0px rgba(68, 68, 68, 0.705);
  -moz-box-shadow: 1px 1px 6px 0px rgba(68, 68, 68, 0.705);
  box-shadow: 1px 1px 6px 0px rgba(68, 68, 68, 0.705);
}

.circle-anime {
  display: flex;
  position: absolute;
  justify-content: center;
  align-content: center;
  width: 60px;
  height: 60px;
  top: 15px;
  right: 15px;
  border-radius: 50%;
  transition: 0.3s;
  background-color: #77bb4a;
  animation: pulse 1.2s 4s ease 4;
}

.popup-whatsapp {
  display: none;
  position: absolute;
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
  width: auto;
  height: auto;
  padding: 10px;
  bottom: 85px;
  right: 6px;
  transition: 0.5s;
  border-radius: 10px;
  background-color: white;
  /* offset-x > | offset-y ^| blur-radius | spread-radius | color */
  -webkit-box-shadow: 2px 1px 6px 0px rgba(68, 68, 68, 0.705);
  -moz-box-shadow: 2px 1px 6px 0px rgba(68, 68, 68, 0.705);
  box-shadow: 2px 1px 6px 0px rgba(68, 68, 68, 0.705);
  animation: slideInRight 0.6s 0s both;
}
.popup-whatsapp > div {
  margin: 5px;
}
@media (max-width: 680px) {
  .popup-whatsapp p {
    font-size: 0.9em;
  }
}
.popup-whatsapp > .content-whatsapp.-top {
  display: flex;
  flex-direction: column;
}
.popup-whatsapp > .content-whatsapp.-top p {
  color: #585858;
  font-family: "Roboto";
  font-weight: 400;
  font-size: 1em;
}
.popup-whatsapp > .content-whatsapp.-bottom {
  display: flex;
  flex-direction: row;
}

.closePopup {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 28px;
  height: 28px;
  margin: 0px 0px 15px 0px;
  border-radius: 50%;
  border: none;
  outline: none;
  cursor: pointer;
  background-color: #f76060;
  -webkit-box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
  -moz-box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
  box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
}
.closePopup:hover {
  background-color: #f71d1d;
  transition: 0.3s;
}

.send-msPopup {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: #ffffff;
  margin: 0px 0px 0px 5px;
  border: none;
  outline: none;
  cursor: pointer;
  -webkit-box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
  -moz-box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
  box-shadow: 1px 1px 2px 0px rgba(68, 68, 68, 0.705);
}
.send-msPopup:hover {
  background-color: #f8f8f8;
  transition: 0.3s;
}

.is-active-whatsapp-popup {
  display: flex;
  animation: slideInRight 0.6s 0s both;
}

input.whats-input[type=text] {
  width: 250px;
  height: 40px;
  box-sizing: border-box;
  border: 0px solid #ffffff;
  border-radius: 20px;
  font-size: 1em;
  background-color: #ffffff;
  padding: 0px 0px 0px 10px;
  -webkit-transition: width 0.3s ease-in-out;
  transition: width 0.3s ease-in-out;
  outline: none;
  transition: 0.3s;
}
@media (max-width: 420px) {
  input.whats-input[type=text] {
    width: 225px;
  }
}
input.whats-input::placeholder {
  /* Most modern browsers support this now. */
  color: rgba(68, 68, 68, 0.705);
  opacity: 1;
}
input.whats-input[type=text]:focus {
  background-color: #f8f8f8;
  -webkit-transition: width 0.3s ease-in-out;
  transition: width 0.3s ease-in-out;
  transition: 0.3s;
}

.icon-whatsapp-small {
  width: 24px;
  height: 24px;
}

.icon-whatsapp {
  width: 45px;
  height: 45px;
}

.icon-font-color {
  color: #ffffff;
}

.icon-font-color--black {
  color: #333333;
}
</style>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

@php
    $contact = \App\Models\Contact::first();
@endphp
<div class="nav-bottom">
    <div class="popup-whatsapp fadeIn">
        <div class="content-whatsapp -top"><button type="button" class="closePopup">
                <i class="material-icons icon-font-color">close</i>
            </button>
            <p>Ingin daftar?</p>
            <p>silahkan hubungi kami dengan mengirim pesan ke WhatsApp.</p>
        </div>
        <div class="content-whatsapp -bottom">
            <input class="whats-input" id="whats-in" type="text" Placeholder="Send message..." />
            <button class="send-msPopup" id="send-btn" type="button">
                <i class="material-icons icon-font-color--black">send</i>
            </button>

        </div>
    </div>
    <button type="button" id="whats-openPopup" class="whatsapp-button">
        <img class="icon-whatsapp" src="https://cdn-icons-png.flaticon.com/512/134/134937.png">
    </button>
    <div class="circle-anime"></div>
</div>


<script>
popupWhatsApp = () => {

  let btnClosePopup = document.querySelector('.closePopup');
  let btnOpenPopup = document.querySelector('.whatsapp-button');
  let popup = document.querySelector('.popup-whatsapp');
  let sendBtn = document.getElementById('send-btn');

  btnClosePopup.addEventListener("click",  () => {
    popup.classList.toggle('is-active-whatsapp-popup')
  })

  btnOpenPopup.addEventListener("click",  () => {
    popup.classList.toggle('is-active-whatsapp-popup')
     popup.style.animation = "fadeIn .6s 0.0s both";
  })

  sendBtn.addEventListener("click", () => {
  let msg = document.getElementById('whats-in').value;
  let relmsg = msg.replace(/ /g,"%20");
    //just change the numbers "91(country code) number" for your number. Don't use +001-(555)1234567
   window.open('https://wa.me/{{ $contact->phone ?? '' }}?text='+relmsg, '_blank');

  });

  setTimeout(() => {
    popup.classList.toggle('is-active-whatsapp-popup');
  }, 3000);
}

popupWhatsApp();

</script>
