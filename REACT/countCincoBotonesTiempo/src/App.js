import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Component } from 'react';
import { Button } from 'reactstrap';

class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      contador: Array(5).fill(0),
      colores: Array(5).fill("secondary"),
    };
  }

  decremento(num) {
    const contadorCopia = [...this.state.contador];
    const coloresCopia = [...this.state.colores];

    if (contadorCopia[num] > 0) {
      contadorCopia[num]--;
    }


    if (contadorCopia[num] === 0) {
      coloresCopia[num] = "secondary";
    }

    const max = Math.max(...contadorCopia);
    const posicion = contadorCopia.indexOf(max);
    coloresCopia.fill("secondary"); 
    if (max > 0){
      coloresCopia[posicion] = "danger";
     } 

    this.setState({
      contador: contadorCopia,
      colores: coloresCopia,
    });
  }

  accionClick(num) {
    const contadorCopia = [...this.state.contador];
    const coloresCopia = [...this.state.colores];

    contadorCopia[num]++;
    const max = Math.max(...contadorCopia);
    const posicion = contadorCopia.indexOf(max);
    coloresCopia.fill("secondary"); 
    coloresCopia[posicion] = "danger";

    this.setState({
      contador: contadorCopia,
      colores: coloresCopia,
    });

    setTimeout(() => {
      this.decremento(num);
    }, 1000);
  }

  render() {
    return (
      <div className="App">
        <header className="App-header">
          <div>
            <Botoncillo color={this.state.colores[0]} onClick={() => this.accionClick(0)} contador={this.state.contador[0]}/>
            <Botoncillo color={this.state.colores[1]} onClick={() => this.accionClick(1)} contador={this.state.contador[1]}/>
            <Botoncillo color={this.state.colores[2]} onClick={() => this.accionClick(2)} contador={this.state.contador[2]}/>
            <Botoncillo color={this.state.colores[3]} onClick={() => this.accionClick(3)} contador={this.state.contador[3]}/>
            <Botoncillo color={this.state.colores[4]} onClick={() => this.accionClick(4)} contador={this.state.contador[4]}/>
          </div>
        </header>
      </div>
    );
  }
}

function Botoncillo(props) {
  return (
    <Button color={props.color} onClick={props.onClick}>
      {props.contador}
    </Button>
  );
}

export default App;
