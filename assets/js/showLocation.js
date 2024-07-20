//This div will be used to show Google map
const mapArea = document.getElementById('map');

const $ = id => document.getElementById(id);

const actionBtn = document.getElementById('showMe');
const labelBtn = document.getElementById('labelShowMe');
const btnLabelShowMe = document.getElementById('btnLabel');
const locationsAvailable = document.getElementById('locationList');



let Gmap, Gmarker;

const __KEY = "AIzaSyD763rO-taCPN02UD8LZW6rzpMzyqmTans";

actionBtn.addEventListener('click', e => {
  // hide the button 
  actionBtn.style.display = "none";
  labelBtn.style.display = "none";
  btnLabelShowMe.style.display = "none";

  // call Materialize toast to update user 
  M.toast({ html: 'Obteniendo tu ubicación. Espere por favor...', classes: 'rounded' });

  // get the user's position
  getLocation();

});

getLocation = () => {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(displayLocation, showError, options)

  }
  else {
    M.toast({ html: 'Lo sentimos, tu navegador web no soporta está función. Por favor, actualiza tu navegador a la versión más reciente.', classes: 'rounded' });
  }
}

// Mostrar localización del usuario
displayLocation = (position) => {
  const lat = position.coords.latitude;
  const lng = position.coords.longitude;

  const latlng = { lat, lng }

  showMap(latlng, lat, lng);
  createMarker(latlng);
  mapArea.style.display = "block";
  getGeolocation(lat, lng);

}

// Recreates the map
showMap = (latlng, lat, lng) => {
  let mapOptions = {
    center: latlng,
    zoom: 15
  };

  Gmap = new google.maps.Map(mapArea, mapOptions);

  Gmap.addListener('drag', function () {
    Gmarker.setPosition(this.getCenter()); // set marker position to map center
  });

  Gmap.addListener('dragend', function () {
    Gmarker.setPosition(this.getCenter()); // set marker position to map center
  });

  Gmap.addListener('idle', function () {

    Gmarker.setPosition(this.getCenter()); // set marker position to map center

    if (Gmarker.getPosition().lat() !== lat || Gmarker.getPosition().lng() !== lng) {
      setTimeout(() => {
        // console.log("I have to get new geocode here!")
        updatePosition(this.getCenter().lat(), this.getCenter().lng()); // update position display
      }, 2000);
    }
  });

}

// Creates marker on the screen
createMarker = (latlng) => {
  let markerOptions = {
    position: latlng,
    map: Gmap,
    animation: google.maps.Animation.BOUNCE,
    clickable: true
    // draggable: true
  };
  Gmarker = new google.maps.Marker(markerOptions);

}

// updatePosition on 
updatePosition = (lat, lng) => {

  getGeolocation(lat, lng);
}

// Displays the different error messages
showError = (error) => {
  mapArea.style.display = "block"
  switch (error.code) {
    case error.PERMISSION_DENIED:
      mapArea.innerHTML = "<svg class='text-center w-6 h-6 text-red-800' aria-hidden='true' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'><path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'/></svg><br><b class='text-center' style='color:red;'>Denegaste los permisos para obtener tu localización. Para usar esta función, acepte los permisos.</b>"
      break;
    case error.POSITION_UNAVAILABLE:
      mapArea.innerHTML = "<br><br><i class='fa-solid fa-circle-exclamation' style='color: red; font-size:50px'></i><br><b style='color:red;'>La información de tu localización no se encuentra disponible en estos momentos, intentelo más tarde.</b>"
      break;
    case error.TIMEOUT:
      mapArea.innerHTML = "<br><br><i class='fa-solid fa-circle-exclamation' style='color: red; font-size:50px'></i><br><b style='color:red'>La solicitud de obtener tu ubicación a tardado mucho tiempo. Por favor, intentelo nuevamente.</b>"
      break;
    case error.UNKNOWN_ERROR:
      mapArea.innerHTML = "<br><br><i class='fa-solid fa-circle-exclamation' style='color: red; font-size:50px'></i><br><b style='color:red'>A ocurrido un error desconocido. Por favor, intentelo nuevamente.</b>"
      break;
  }
}

const options = {
  enableHighAccuracy: true
}

getGeolocation = (lat, lng) => {

  const latlng = lat + "," + lng;

  fetch(`https://maps.googleapis.com/maps/api/geocode/json?latlng=${latlng}&key=${__KEY}`)

    .then(res => res.json())
    .then(data => populateCard(data.results));

}

function removeAddressCards() {
  if (locationsAvailable.hasChildNodes()) {
    while (locationsAvailable.firstChild) {
      locationsAvailable.removeChild(locationsAvailable.firstChild);
    }
  }
}

populateCard = (geoResults) => {
  // check if a the container has a child node to force re-render of dom
  removeAddressCards();

  geoResults.map(geoResult => {

    // first create the input div container
    const addressCard = document.createElement('div');

    // then create the input and label elements
    const input = document.createElement('input');
    const label = document.createElement('label');

    // then add materialize classes to the div and input
    addressCard.classList.add("card");
    input.classList.add("with-gap");

    // add attributes to them
    label.setAttribute("for", geoResult.place_id);
    label.innerHTML = geoResult.formatted_address;

    input.setAttribute("name", "address");
    input.setAttribute("type", "radio");
    input.setAttribute("value", geoResult.formatted_address);
    input.setAttribute("id", geoResult.place_id);
    // input.addEventListener('click', e => console.log(123));
    input.addEventListener('click', () => inputClicked(geoResult));
    // finalResult = input.value;
    finalResult = geoResult.formatted_address;


    addressCard.appendChild(input);
    addressCard.appendChild(label);

    // console.log(geoResult.formatted_address)

    return (
      locationsAvailable.appendChild(addressCard)
    );
  })
}

inputClicked = (result) => {

  result.address_components.map(component => {
    const types = component.types

    if (types.includes('postal_code')) {
      $('postal_code').value = component.long_name
    }

    if (types.includes('locality')) {
      $('locality').value = component.long_name
    }

    if (types.includes('administrative_area_level_2')) {
      $('city').value = component.long_name
    }

    if (types.includes('administrative_area_level_1')) {
      $('state').value = component.long_name
    }

    if (types.includes('point_of_interest')) {
      $('landmark').value = component.long_name
    }
  });

  $('address').value = result.formatted_address;

  // to avoid labels overlapping prefilled contents
  M.updateTextFields();
  removeAddressCards();
}
