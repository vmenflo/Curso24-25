import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';
import axios from 'axios';
const axios = require('axios');
function App() {

  // Hacer una petición para un usuario con ID especifico
  axios.get('http://localhost/Proyectos/Curso24-25/PHP/Tema_6_Servicios_WEB/Teor_SW/API/Saludo')
  .then(function (response) {
    // manejar respuesta exitosa
    console.log(response);
  })
  .catch(function (error) {
    // manejar error
    console.log(error);
  })
  .finally(function () {
    // siempre sera executado
  });
  // axios.<method> proveerá autocompletado y tipificación  de parámetros

  return (
    <div className="App">
      <Button >
        Saludar
      </Button>
    </div>
  );
}

export default App;