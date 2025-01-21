import React, { Component } from 'react';
import { Button } from 'reactstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

function Botonera(props) {
  if (props.playable) {
    let lista = [];

    // Suponiendo que `props.listaBotones` es un arreglo bidimensional
    for (let i = 0; i < props.listaBotones.length; i++) {
      for (let j = 0; j < props.listaBotones[i].length; j++) {
        // Corregimos la generación de botones
        if (i % 2 === 0) {
          lista.push(<Button onClick={()=>props.clicar(i,j)} color={props.listaBotones[i][j].color} key={`btn-${i}-${j}`} />);
          lista.push(<Button outline key={`btn-out-${i}-${j}`} />);
        } else {
          lista.push(<Button outline key={`btn-out-${i}-${j}`} />);
          lista.push(<Button onClick={()=>props.clicar(i,j)} color={props.listaBotones[i][j].color} key={`btn-${i}-${j}`} />);
        }
      }
      lista.push(<br key={`br-${i}`} />);
    }
    return <>{lista}</>;
  }
}

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      listaBotones: [], // Inicializamos como array vacío
      playable: false,
      fila:-1,
      columna:-1
    };
  }

  clicar(i, j) {
    let copiaLista=this.state.listaBotones
    let cf = this.state.fila
    let cc = this.state.columna

    if(cf!==-1){
      if (
        ((i === cf - 1 && (j === cc - 1 || j === cc + 1)) || // Movimientos hacia arriba y diagonal
        (i === cf + 1 && (j === cc - 1 || j === cc + 1)))  && copiaLista[i][j].libre  // Movimientos hacia abajo y diagonal
      ){
        copiaLista[i][j].color="success"
        copiaLista[i][j].libre=false
        copiaLista[cf][cc].libre=true
        copiaLista[cf][cc].color="secondary"
        cf=-1
        cc=-1
      }else{
        copiaLista[cf][cc].color="success"
        cf=-1
        cc=-1
      }

    }else{
      copiaLista[i][j].color="primary";
      cf=i
      cc=j
    }
    
    this.setState({listaBotones:copiaLista,fila:cf,columna:cc})
  }

  jugar() {
    let copPlayable = this.state.playable;
    let copLista = [];

    if (!copPlayable) {
      // Creamos la lista de botones dinámicamente como un arreglo bidimensional
      for (let i = 0; i < 8; i++) {
        let fila = [];
        for (let j = 0; j < 4; j++) {
          if (i < 5) {
            fila.push({ libre: true, color: "secondary" });
          } else {
            fila.push({ libre: true, color: "success" });
          }
        }
        copLista.push(fila); // Agregamos la fila al arreglo principal
      }
      copPlayable = true;
    } else {
      // Si ya está en modo jugable, reseteamos
      copLista = [];
      copPlayable = false;
    }

    this.setState({ listaBotones: copLista, playable: copPlayable });
  }

  render() {
    return (
      <div className="App">
        <header className="App-header">
          <Button onClick={() => this.jugar()}>Jugar</Button>
          <br />
          <Botonera clicar={(i,j)=>this.clicar(i,j)} listaBotones={this.state.listaBotones} playable={this.state.playable} />
        </header>
      </div>
    );
  }
}

export default App;
