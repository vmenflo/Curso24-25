import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Component } from 'react';
import { Button } from 'reactstrap';

class App extends Component {
  constructor(props) {

    super(props);
    this.state = {
      contador: 0,
      colores: Array(5).fill("secondary"),
      memoria: [],
    };
  }
  accionBtn(num) {
    const copiaColores = [...this.state.colores]
    let copiaContador = this.state.contador
    const copiaMemoria = [...this.state.memoria]

    if (!copiaMemoria.includes(num)) {
      copiaMemoria.push(num)
      copiaColores[num] = "danger"
      copiaContador++
    }
    
    this.setState({
      contador: copiaContador,
      colores: copiaColores,
      memoria: copiaMemoria
    })
  }

  render() {
    return (
      <div className="App">
        <header className="App-header">
          <div>
            {this.state.contador}
          </div>
          <div>
            <Botoncillo color={this.state.colores[0]} onClick={()=>this.accionBtn(0)}/>
            <Botoncillo color={this.state.colores[1]} onClick={()=>this.accionBtn(1)}/>
            <Botoncillo color={this.state.colores[2]} onClick={()=>this.accionBtn(2)}/>
            <Botoncillo color={this.state.colores[3]} onClick={()=>this.accionBtn(3)}/>
            <Botoncillo color={this.state.colores[4]} onClick={()=>this.accionBtn(4)}/>
          </div>
        </header>
      </div>
    );
  }
}

function Botoncillo(props) {
  return (
    <Button color={props.color} onClick={props.onClick}></Button>
  );
}

export default App;
