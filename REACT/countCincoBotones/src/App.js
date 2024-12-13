import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import { Component } from 'react';
import { Button } from 'reactstrap';

class App extends Component {
  constructor(props) {

    super(props);
    this.state = {
      contador:Array(5).fill(0),
      colores:Array(5).fill("secondary"),
    };
  }

  render() {
    return (
      <div className="App">
        <header className="App-header">
          <div>
            <Button color={this.state.colores[0]} onClick={()=>Botoncillo(0,this)}>{this.state.contador[0]}</Button>
            <Button color={this.state.colores[1]} onClick={()=>Botoncillo(1,this)}>{this.state.contador[1]}</Button>
            <Button color={this.state.colores[2]} onClick={()=>Botoncillo(2,this)}>{this.state.contador[2]}</Button>
            <Button color={this.state.colores[3]} onClick={()=>Botoncillo(3,this)}>{this.state.contador[3]}</Button>
            <Button color={this.state.colores[4]} onClick={()=>Botoncillo(4,this)}>{this.state.contador[4]}</Button>
          </div>
        </header>
      </div>
    );
  }
}

function Botoncillo(num, componente) {
  const copia = [...componente.state.colores]
  const contadorCopia = [...componente.state.contador]

  if(contadorCopia[num]===0){
    copia[num]="danger"
    contadorCopia[num]++
    componente.setState({colores:copia})
    componente.setState({contador:contadorCopia})
  }else{
    contadorCopia[num]++
    componente.setState({contador:contadorCopia})
  }
  
  
}

export default App;
