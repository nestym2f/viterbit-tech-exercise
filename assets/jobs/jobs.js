document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('application_email').value == '';
    document.getElementById('application_phone').value == '';
    document.getElementById('application_candidateName').value == '';
    document.getElementById('application_positionAppliedFor').value == '';    
});
const alertPlaceholder = document.getElementById('liveAlertPlaceholder')

const validateFields = () => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phoneRegex = /^\d{7,12}$/;
    const email = document.getElementById('application_email').value;
    const phoneNumber = document.getElementById('application_phone').value;
    const candidateName = document.getElementById('application_candidateName').value;
    const positionAppliedFor = document.getElementById('application_positionAppliedFor').value;
    
    if(!emailRegex.test(email)){
        appendAlert('Please check your email!', 'danger')    
        return;
    }        
        
    if (!phoneRegex.test(phoneNumber)){
        appendAlert('Please check your phone number!', 'danger');
        return;
    }        

    if (candidateName.length < 3){
        appendAlert('Please check your candidate name!', 'danger');        
        return;
    }        
    
    if (positionAppliedFor.length < 5){
        appendAlert('Please check your position Applied For!', 'danger');
        return;
    }
    
    const form = document.getElementsByName('application');
    form[0].submit();
}

const appendAlert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}