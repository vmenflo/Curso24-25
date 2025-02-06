import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Button } from 'reactstrap';
import axios from 'axios';
import { useState } from 'react';

function App() {
  const [usuario, setUsuario] = useState('');
  const [clave, setClave] = useState('');

  const handleLogin = async () => {
    try {
      const response = await axios.post('http://localhost/servicios_rest/login', { usuario, clave });
      console.log(response.data);
      if (response.data.success) {
        alert('Login exitoso');
      } else {
        alert('Login fallido');
      }
    } catch (error) {
      console.error('Error en login:', error);
    }
  };

  const handleVerArticulo = async () => {
    try {
      const response = await axios.get('http://localhost/servicios_rest/productos.php?id_producto=1');
      console.log('Datos del producto:', response.data);
    } catch (error) {
      console.error('Error al obtener el producto:', error);
    }
  };

  return (
    <div>
      <h3>Bienvenido a la página web de la Actividad 3</h3>
      <div>
        <p>Rellene los campos para acceder</p>
        <p>
          <label>Usuario:</label>
          <input type="text" value={usuario} onChange={(e) => setUsuario(e.target.value)} />
        </p>
        <p>
          <label>Contraseña:</label>
          <input type="password" value={clave} onChange={(e) => setClave(e.target.value)} />
        </p>
        <Button color="primary" onClick={handleLogin}>Login</Button>
      </div>
      <br />
      <Button color="primary" onClick={handleVerArticulo}>Ver Detalles del artículo 1</Button>
    </div>
  );
}

export default App;
