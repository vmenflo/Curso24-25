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

  accionClick(num) {
    const copia = [...this.state.colores];
    const contadorCopia = [...this.state.contador];    

    if (contadorCopia[num] === 0) {
      copia[num] = "danger";
    }
    contadorCopia[num]++;
    this.setState({
      colores: copia,
      contador: contadorCopia,
    });


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
