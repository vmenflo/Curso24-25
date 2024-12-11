import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Component } from 'react';
import { Button } from 'reactstrap';

class App extends Component {
  constructor(props) {

    super(props);
    this.state = {
      contador:0,
      colores:Array(5).fill("secondary"),
      memoria : [],
    };
  }

  render() {
    return (
      <div className="App">
        <header className="App-header">
          <div>
            {this.state.contador}
          </div>
          <div>
            <Button color={this.state.colores[0]} onClick={()=>Botoncillo(0,this)}></Button>
            <Button color={this.state.colores[1]} onClick={()=>Botoncillo(1,this)}></Button>
            <Button color={this.state.colores[2]} onClick={()=>Botoncillo(2,this)}></Button>
            <Button color={this.state.colores[3]} onClick={()=>Botoncillo(3,this)}></Button>
            <Button color={this.state.colores[4]} onClick={()=>Botoncillo(4,this)}></Button>
          </div>
        </header>
      </div>
    );
  }
}

function Botoncillo(num, componente) {
  const copia = [...componente.state.colores]
  const registro = [...componente.state.memoria]
  if(!registro.includes(num)){
    const cuenta = componente.state.contador + 1
    copia[num]="danger"
    componente.setState({colores:copia})
    componente.setState({contador:cuenta})
    registro.push(num)
    componente.setState({memoria:registro})
  }
  
  
}

export default App;
