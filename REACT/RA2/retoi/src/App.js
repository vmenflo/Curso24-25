import './App.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import React, { Component } from 'react'
import { Button } from 'reactstrap';

class App extends Component {
  constructor(props){
    super(props);
    this.state={color:"secondary"};

    // Enlazar
    this.rojo = this.rojo.bind(this)
    this.azul = this.azul.bind(this)
  }
  

  //Metodos para cambiar
  rojo(){this.setState({color:"danger"})}
  azul(){this.setState({color:"primary"})}
  render() {
    return (
      <div className="App">
        <Button color={this.state.color}>
          Dale
        </Button>
        <Button color='primary' onClick={this.azul}>
          Dale
        </Button>
        <Button color="danger" onClick={this.rojo}>
          Dale
        </Button>
      </div>
    );
  }
}

export default App;