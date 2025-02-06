import 'bootstrap/dist/css/bootstrap.min.css';
import React, { Component } from 'react';
import Menu from './componentes/Menu'
import AppLogin from './componentes/AppLogin'
class App extends Component {
  constructor(props) {
    super(props);
    this.state = {
      menuItem: "UNO",
      logged: false,
    }
  }

  changeMenu(item) {
    this.setState({ menuItem: item })
  }

  userLogin(telefono, password, info) {
if(telefono == "" || password ==" "){
  return 'Cumplimente los datos'
}else{
  if (telefono == "myfpschool@gmail.com" && password == "2025") {
    this.setState({ logged: true })
  }else{
    return'DATOS INCORRECTOS'
  }
}

    
  }
  render() {
    let obj = <Menu menuItem={this.state.menuItem}
      changeMenu={(item) => this.changeMenu(item)} />

    let contenido = <></>
    if(this.state.logged){
      switch (this.state.menuItem) {
        case 'UNO':
            contenido=<p>Has pulsado el botón UNO </p>
            break;
        case 'DOS':
          contenido=<p>Has pulsado el botón DOS </p>
          break;
        case 'TRES':
          contenido=<p>Has pulsado el botón TRES </p>
          break;
    }
    }

    if (!this.state.logged) {
      obj = <AppLogin
        userLogin={(telefono, password) => this.userLogin(telefono, password)}
      />
    }
    return (
      <div className="App">
        {obj}
        {<br/>}
        {contenido}
      </div>
    );
  }

}
export default App;