import React, { Component } from 'react';
import { Button } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

function Botonera(props) {
    let lista = [];
    for (let i = 0; i < props.listaBotones.length; i++) {
      for (let j = 0; j < props.listaBotones[i].length; j++) {
        lista.push(<Button key={i*10+j} onClick={()=>props.clicar(i,j)} color={props.listaBotones[i][j].color} pulsado={props.listaBotones[i][j].pulsado}/>)
      }
      lista.push(<br/>)      
    }
    return <>{lista}</>;
  
}

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listaBotones: [], // Inicializamos como array vacío
      colores:["success","danger", "warning","secondary"]
    };
  }

  componentDidMount() {
    let copiaLista = []

    for (let i = 0; i < 9; i++) {
      let lista =[]
      for (let j = 0; j < 9; j++) {
        lista.push({color:"primary", pulsado:false});
      }
      copiaLista.push(lista)
    }

    this.setState({listaBotones:copiaLista});
  }
  

  clicar(i, j) {
    let copia = this.state.listaBotones;
  
    // Marca el botón inicial como pulsado
    copia[i][j].pulsado = true;
  
    // Reinicia todos los colores a "primary"
    for (let i = 0; i < copia.length; i++) {
      for (let j = 0; j < copia[i].length; j++) {
        copia[i][j].color = "primary";
      }
    }
  
    const colores = this.state.colores; 
    let contador = 0; 
  
    // Función recursiva para colorear los vecinos
    const colorear = (i, j, color) => {
      // Verifica si está dentro del rango y pulsado
      if (
        i >= 0 &&
        j >= 0 &&
        i < copia.length &&
        j < copia[i].length &&
        copia[i][j].pulsado &&
        copia[i][j].color === "primary"
      ) {
        copia[i][j].color = color; // Asigna el color actual
  
        // Llama recursivamente para los vecinos
        colorear(i - 1, j, color); // Arriba
        colorear(i + 1, j, color); // Abajo
        colorear(i, j - 1, color); // Izquierda
        colorear(i, j + 1, color); // Derecha
      }
    };
  
    // Lógica del clic
    let flag = true;
    while (flag) {
      flag = false;
  
      for (let i = 0; i < copia.length; i++) {
        for (let j = 0; j < copia[i].length; j++) {
          if (copia[i][j].pulsado && copia[i][j].color === "primary") {
            const colorActual = colores[contador];
            colorear(i, j, colorActual); 
            if(contador===3){
              contador=0
            }else{
              contador++
            }
            flag = true; 
          }
        }
      }
    }
  
    this.setState({ listaBotones: copia });
  }
  

  render() {
    return (
      <div className="App">
        <header className="App-header">
          <Botonera clicar={(i,j)=>this.clicar(i,j)} listaBotones={this.state.listaBotones} />
        </header>
      </div>
    );
  }
}

export default App;
