const BASE_URL = "/creation_cabinet/public"

function ajaxRequest(url, method, data, successCallback, errorCallback) {
  const xhr = new XMLHttpRequest()
  xhr.open(method, url, true)
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
  xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest")

  xhr.onload = () => {
    if (xhr.status === 200) {
      try {
        const response = JSON.parse(xhr.responseText)
        successCallback(response)
      } catch (e) {
        console.error("Response:", xhr.responseText)
        console.error("Parse error:", e)
        errorCallback("Erreur de parsing JSON")
      }
    } else {
      console.error("Status:", xhr.status)
      console.error("Response:", xhr.responseText)
      errorCallback("Erreur de requête HTTP: " + xhr.status)
    }
  }

  xhr.onerror = () => {
    console.error("Network Error")
    errorCallback("Erreur réseau")
  }

  xhr.send(data)
}

function updateAppointment(appointmentId, newStatus) {
  const data = new URLSearchParams()
  data.append("rdv_id", appointmentId)
  data.append("statut", newStatus)

  ajaxRequest(
    BASE_URL + "?action=update_appointment",
    "POST",
    data.toString(),
    (response) => {
      if (response.success) {
        document.getElementById("success-message").textContent = response.message
        document.getElementById("success-message").style.display = "block"
        document.getElementById("status-display").textContent = newStatus
      } else {
        alert("Erreur: " + response.message)
      }
    },
    (error) => {
      alert("Erreur: " + error)
    },
  )
}

function replyToConsultation(consultationId, response) {
  const data = new URLSearchParams()
  data.append("rdv_id", consultationId)
  data.append("reponse", response)

  ajaxRequest(
    BASE_URL + "?action=reply_consultation",
    "POST",
    data.toString(),
    (response) => {
      if (response.success) {
        alert(response.message)
        window.location.reload()
      } else {
        alert("Erreur: " + response.message)
      }
    },
    (error) => {
      alert("Erreur: " + error)
    },
  )
}

