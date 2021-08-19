{
  const handleSubmitForm = e => {
    const $form = e.currentTarget;
    if (!$form.checkValidity()) {
      e.preventDefault();
      // wanneer je submit als er nog fouten zijn, komen de foutmeldingen op het scherm wanneer er op submit geklikt wordt 
      const inputs = document.querySelectorAll(`.input`);
      inputs.forEach($input => showValidationInfo($input));
    }
  }

  const handleInputField = e => {
    const $input = e.currentTarget;
    const $error = $input.parentElement.querySelectorAll(`.error`);
    if($input.checkValidity()){
      $error.textContent = ``;
    }
  };

  const showTypeMismatch = type => {
    switch (type) {
      case `email`:
        return `e-mailadres`;
      case `url`:
        return `website url`;
      case `tel`:
        return `telefoonnummer`;
    }
  }

  const showValidationInfo = $input => {
    // selecteren van het error veld bij elk element
    const $error = $input.parentElement.querySelectorAll(`.error`);

    // controle of het veld ingevuld is
    if ($input.validity.valueMissing) {
      $error.textContent = `This is a required field`;
    }
    // controle of input matcht met type attribute
    if ($input.validity.typeMismatch) {
      $error.textContent = `A ${showTypeMismatch($input.getAttribute(`type`))} is expected`;
    }
    // controle of de maximale lengte niet overschreden is
    if ($input.validity.tooLong) {
      $error.textContent = `Input contains max. ${$input.getAttribute(`maxlength`)} characters`;
    }
    // controle of de minimale lengte wel gehaald werd
    if ($input.validity.tooShort) {
      $error.textContent = `Input contains min. ${$input.getAttribute(`minlength`)} characters`;
    }
    // controle of de input groter of gelijk is aan de kleinst mogelijke waarde
    if ($input.validity.rangeUnderflow) {
      $error.textContent = `The value should be equal to or greater than ${$input.getAttribute(`min`)}`;
    }
    // controle of de input kleiner of gelijk is aan de grootst mogelijke waarde
    if ($input.validity.rangeOverflow) {
      $error.textContent = `The value should be equal to or less than ${$input.getAttribute(`max`)}`;
    }
  }

  const handleBlurInput = e => {
    showValidationInfo(e.currentTarget);
  };

  const init = () => {
    const $forms = document.querySelectorAll(`form`);
    $forms.noValidate = true;
    $forms.forEach($form => {
      $form.addEventListener(`submit`, handleSubmitForm);
    })
    

    const inputs = document.querySelectorAll(`.input`);
    inputs.forEach($input => {
      $input.addEventListener(`blur`, handleBlurInput);
      $input.addEventListener(`input`, handleInputField);
    });
  };

  init();
}

